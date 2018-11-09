<?php

use PhpOffice\PhpWord\TemplateProcessor;

class SaiaTemplateProcessor extends TemplateProcessor {

	protected $_types;
	protected $_rels;
	protected $_countRels;

	public function __construct($documentTemplate) {
		parent::__construct($documentTemplate);
		$this->_rels        = $this->zipClass->getFromName('word/_rels/document.xml.rels'); #erap 07/07/2015
		$this->_types       = $this->zipClass->getFromName('[Content_Types].xml'); #erap 07/07/2015
		$this->_countRels   = substr_count($this->_rels, 'Relationship') - 1; #erap 07/07/2015
	}

	function setTextWatermark($texto) {
		foreach ( $this->tempDocumentHeaders as $index => $headerXML ) {
			$header = new \SimpleXMLElement($headerXML);
			$textpath = $header->xpath('//v:textpath');
			foreach ( $textpath as $dato => $valor ) {
				if ($valor->attributes()->{'string'}) {
					$valor->attributes()->{'string'} = $texto;
				}
			}
			// if(in_array($text))
			$this->tempDocumentHeaders[$index] = $header->asXML();
		}
	}

	public function setImg($strKey, $arrImgPath) {
		// 289x108
		$strKey = '${' . $strKey . '}';
		$relationTmpl = '<Relationship Id="RID" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/IMG"/>';
		$imgTmpl = '<w:pict><v:shape type="#_x0000_t75" style="width:WIDpx;height:HEIpx"><v:imagedata r:id="RID" o:title=""/></v:shape></w:pict>';
		$typeTmpl = ' <Override PartName="/word/media/IMG" ContentType="image/EXT"/>';
		$toAdd = $toAddImg = $toAddType = '';
		$aSearch = array(
				'RID',
				'IMG'
		);
		$aSearchType = array(
				'IMG',
				'EXT'
		);
		$imgExt = 'jpeg';
		foreach ( $arrImgPath as $img ) {
			$imgName = 'img' . $this->_countRels . '.' . $imgExt;
			$rid = 'rId' . $this->_countRels++;
			$this->zipClass->addFile($img['img'], 'word/media/' . $imgName);
			if (isset($img['size'])) {
				$w = $img['size'][0];
				$h = $img['size'][1];
			} else {
				$w = 289;
				$h = 108;
			}
			$toAddImg .= str_replace(array(
					'RID',
					'WID',
					'HEI'
			), array(
					$rid,
					$w,
					$h
			), $imgTmpl);
			if (isset($img['dataImg'])) {
				$toAddImg .= '<w:br/><w:t>' . $this->limpiarString($img['dataImg']) . '</w:t><w:br/>';
			}
			$aReplace = array(
					$imgName,
					$imgExt
			);
			$toAddType .= str_replace($aSearchType, $aReplace, $typeTmpl);

			$aReplace = array(
					$rid,
					$imgName
			);
			$toAdd .= str_replace($aSearch, $aReplace, $relationTmpl);
		}

		$strKey2 = '\\' . $strKey;
		$expresion = '/(<w:t>)(.*)(' . $strKey2 . ')(.*)(<\/w:t>)/i';
		if (preg_match($expresion, $this->tempDocumentMainPart)) {
			preg_match($expresion, $this->tempDocumentMainPart, $coincidencias);
			$cadena_final = $coincidencias[1] . $coincidencias[2] . $coincidencias[5] . $coincidencias[1] . $coincidencias[3] . $coincidencias[5] . $coincidencias[1] . $coincidencias[4] . $coincidencias[5];
			$this->tempDocumentMainPart = str_replace($coincidencias[0], $cadena_final, $this->tempDocumentMainPart);
		}

		// Hacer una expresion regular para reemplazar el <w:t> Cualquier cadena ${variable} cualquier cadena2 </w:t> y debe quedar <w:t> Cualquier cadena </w:t> IMAGEN <w:t> cualquier cadena2 </w:t>
		$this->tempDocumentMainPart = str_replace('<w:t>' . $strKey . '</w:t>', $toAddImg, $this->tempDocumentMainPart);
		$this->_types = str_replace('</Types>', $toAddType, $this->_types) . '</Types>';
		$this->_rels = str_replace('</Relationships>', $toAdd, $this->_rels) . '</Relationships>';
	}

	//TODO: Este codigo debe actualizarse en cada cambio de version de la libreria phpword
	public function save() {
		foreach ($this->tempDocumentHeaders as $index => $xml) {
			$this->zipClass->addFromString($this->getHeaderName($index), $xml);
		}

		$this->zipClass->addFromString($this->getMainPartName(), $this->tempDocumentMainPart);

		foreach ($this->tempDocumentFooters as $index => $xml) {
			$this->zipClass->addFromString($this->getFooterName($index), $xml);
		}

		// INICIO Codigo reemplazo platilla imagen
		if($this->_rels!="") {
			$this->zipClass->addFromString('word/_rels/document.xml.rels', $this->_rels);
		}
		if($this->_types!="") {
			$this->zipClass->addFromString('[Content_Types].xml', $this->_types);
		}
		// FIN Codigo reemplazo platilla imagen

		// Close zip file
		if (false === $this->zipClass->close()) {
			throw new Exception('Could not close zip file.');
		}

		return $this->tempDocumentFilename;
	}

	function limpiarString($str) {
		return str_replace(array(
				'&',
				'<',
				'>',
				"\n"
		), array(
				'&amp;',
				'&lt;',
				'&gt;',
				"\n" . '<w:br/>'
		), $str);
	}

}

