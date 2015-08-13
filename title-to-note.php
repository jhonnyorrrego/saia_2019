<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Title To Note</title>
<script type="text/javascript" src="js/title2note.js"></script>

<style type="text/css" media="screen">
<!--
@import "../global.css";

@import "css/title2note.css";

/* for presentation only */
html, body {
   height: 100%;
   overflow: hidden;
}
#container {
   height: 100%;
   overflow: auto;
   position: relative;
   z-index: 2;
}

-->
</style>

</head>
<body>
<div id="container">
<h1>Title To Note</h1>
<p class="abstract"><strong>Show HTML-element titles in right bottom corner.</strong></p>
<address>2005-01-01 <a href="../">Home</a></address>
<script type="text/javascript" src="../global.js"></script>

<h2>HTML</h2>
<pre>&lt;a href="#" title="b&auml;&auml;h"&gt;TestLink&lt;/a&gt;</pre>
<p>becomes <strong><a href="#" title="b&auml;&auml;h">TestLink</a></strong> <em>&lt;- Hover this and look on the bottom right.</em></p>

<h2>JS</h2>
<p>A <code>div</code> with <var>id="note"</var> is dynamically created and event handlers are added to elements for displaying <code>title</code> values on mouseover.</p>
<pre>
&lt;script type="text/javascript" src="<a href="title2note.js" title="Save script and add this line to the head section of your document.">title2note.js</a>"&gt;&lt;/script&gt;
</pre>
<p>Define in <code>title2note.js</code> which elements should be affected:</p>
<pre>
var titledElements = ['a', 'img'];
</pre>

<h2>CSS</h2>
<p>The <code>div</code> is fix positioned. In IE absolute.</p>
<pre>
#title2note{
    position: fixed;
    ...
    }
/* star html hack - IE only */
* html #title2note{
    position: absolute;
    }

        <a href="title2note.css" title="Add this to your stylesheet">-&raquo; show full title2note.css</a>
</pre>
<p>IE5+ uses viewport values for <code>position:absolute</code> and not document values. This keeps the note on the bottom when scrolling.</p>

<h2>Examples</h2>
<p><img src="title2note.jpg" width="320" height="240" alt="TestImage" title="Stargarder Straße in  Berlin Prenzlauer Berg"> <em>&lt;- Hover this image.</em><br><br></p>
<p><strong><a href="#" title="a very testy link">TestLink</a></strong> <em>&lt;- Hover this link.</em><br><br></p>
<p><a href="#" title="copy shop near Helmholtzplatz in Berlin Prenzlauer Berg"><img src="title2note2.jpg" width="320" height="240" alt="TestImage"></a> <em>&lt;- Hover this linked image (title in a-element, no title in img-element).</em><br><br></p>

<p><em>Should work in browsers with support for DOM and position:fixed and also in IE 5+.</em></p>
<p>Tested in: Firefox, IE5+, Opera7</p>
</div>
</body>
</html>
