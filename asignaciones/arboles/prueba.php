<!--conf
<sample>
              <product version="1.5" edition="pro"/>
                     <modifications>
                            <modified date="070101"/>
                     </modifications>
               </sample>
 --> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title> Search</title>
</head>
	<link rel="STYLESHEET" type="text/css" href="../codebase/dhtmlxtree.css">
	
	<script  src="codebase/dhtmlxcommon.js"></script>
	<script  src="codebase/dhtmlxtree.js"></script>
<body>
<link rel='STYLESHEET' type='text/css' href='common/style.css'>
		
	<table>
		<tr>
			<td>
				<div id="treeboxbox_tree" style="width:250; height:218;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;"/>
			</td>
			<td rowspan="2" style="padding-left:25" valign="top">
				<input type="text" id="stext" width="200px"> <a href="javascript:void(0)" onclick="tree.findItem(document.getElementById('stext').value,0,1)"> Find </a> | <a href="javascript:void(0)" onclick="tree.findItem(document.getElementById('stext').value)"> Find Next</a> | <a href="javascript:void(0)" onclick="tree.findItem(document.getElementById('stext').value,1)"> Find Prev </a>
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>

<div class='sample_code'><div class="hl-main"><pre><span class="hl-code"> 
</span><span class="hl-brackets">&lt;</span><span class="hl-reserved">div</span><span class="hl-code"> </span><span class="hl-var">id</span><span class="hl-code">=</span><span class="hl-quotes">&quot;</span><span class="hl-string">treeboxbox_tree</span><span class="hl-quotes">&quot;</span><span class="hl-code"> </span><span class="hl-var">style</span><span class="hl-code">=</span><span class="hl-quotes">&quot;</span><span class="hl-string">width:200;height:200</span><span class="hl-quotes">&quot;</span><span class="hl-brackets">&gt;</span><span class="hl-brackets">&lt;/</span><span class="hl-reserved">div</span><span class="hl-brackets">&gt;</span><span class="hl-code">
</span><span class="hl-brackets">&lt;</span><span class="hl-reserved">script</span><span class="hl-brackets">&gt;</span><span class="hl-code"><div class="hl-main"><pre><span class="hl-code"> 
    </span><span class="hl-identifier">tree</span><span class="hl-code">=</span><span class="hl-reserved">new</span><span class="hl-code"> </span><span class="hl-identifier">dhtmlXTreeObject</span><span class="hl-brackets">(</span><span class="hl-quotes">&quot;</span><span class="hl-string">treeboxbox_tree</span><span class="hl-quotes">&quot;</span><span class="hl-code">,</span><span class="hl-quotes">&quot;</span><span class="hl-string">100%</span><span class="hl-quotes">&quot;</span><span class="hl-code">,</span><span class="hl-quotes">&quot;</span><span class="hl-string">100%</span><span class="hl-quotes">&quot;</span><span class="hl-code">,</span><span class="hl-number">0</span><span class="hl-brackets">)</span><span class="hl-code">;
        </span><span class="hl-identifier">tree</span><span class="hl-code">.</span><span class="hl-identifier">setImagePath</span><span class="hl-brackets">(</span><span class="hl-quotes">&quot;</span><span class="hl-string">../imgs/</span><span class="hl-quotes">&quot;</span><span class="hl-brackets">)</span><span class="hl-code">;
        </span><span class="hl-identifier">tree</span><span class="hl-code">.</span><span class="hl-identifier">loadXML</span><span class="hl-brackets">(</span><span class="hl-quotes">&quot;</span><span class="hl-string">tree.xml</span><span class="hl-quotes">&quot;</span><span class="hl-brackets">)</span><span class="hl-code">
        
        ...
        </span><span class="hl-identifier">tree</span><span class="hl-code">.</span><span class="hl-identifier">findItem</span><span class="hl-brackets">(</span><span class="hl-identifier">searchString</span><span class="hl-brackets">)</span><span class="hl-code">; </span><span class="hl-comment">//</span><span class="hl-comment">find item next to current selection</span><span class="hl-comment"></span><span class="hl-code">
        </span><span class="hl-identifier">tree</span><span class="hl-code">.</span><span class="hl-identifier">findItem</span><span class="hl-brackets">(</span><span class="hl-identifier">searchString</span><span class="hl-code">,</span><span class="hl-number">1</span><span class="hl-code">,</span><span class="hl-number">1</span><span class="hl-brackets">)</span><span class="hl-code">; </span><span class="hl-comment">//</span><span class="hl-comment">find item previous to current selection</span><span class="hl-comment"></span><span class="hl-code">
        </span><span class="hl-identifier">tree</span><span class="hl-code">.</span><span class="hl-identifier">findItem</span><span class="hl-brackets">(</span><span class="hl-identifier">searchString</span><span class="hl-code">,</span><span class="hl-number">0</span><span class="hl-code">,</span><span class="hl-number">1</span><span class="hl-brackets">)</span><span class="hl-code">; </span><span class="hl-comment">//</span><span class="hl-comment">find item from top</span><span class="hl-comment"></span></pre></div></span><span class="hl-brackets">&lt;/</span><span class="hl-reserved">script</span><span class="hl-brackets">&gt;</span></pre></div></div>
	<script>
			tree=new dhtmlXTreeObject("treeboxbox_tree","100%","100%",0);
			tree.setImagePath("../codebase/imgs/csh_bluebooks/");
			tree.enableSmartXMLParsing(true);
			tree.loadXML("../test_calidad.php")
	</script>


<!-- FOOTER -->
<table callspacing="0" cellpadding="0" border="0" class="sample_footer"><tr><td style="padding-left: 8px;">&copy; <a href="http://www.dhtmlx.com">DHTMLX LTD</a>. All rights reserved</td></tr></table>
<!-- FOOTER -->

</body>
</html>
