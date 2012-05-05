<pre>Array
(
)
</pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3a6cc-trace').style.display = (document.getElementById('cakeErr4f4d957d3a6cc-trace').style.display == 'none' ? '' : 'none');"><b>Notice</b> (8)</a>: Undefined index: Documento [<b>APP/Controller/DocumentosController.php</b>, line <b>145</b>]<div id="cakeErr4f4d957d3a6cc-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3a6cc-code').style.display = (document.getElementById('cakeErr4f4d957d3a6cc-code').style.display == 'none' ? '' : 'none')">Code</a><pre id="cakeErr4f4d957d3a6cc-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pr($this-&gt;request-&gt;data);</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$this-&gt;respond('Subido&nbsp;el&nbsp;Archivo...');</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$results&nbsp;=&nbsp;$this-&gt;uploadFile($this-&gt;folderPath,&nbsp;$this-&gt;request-&gt;data['Documento']);</span></code></span></pre><pre class="stack-trace">DocumentosController::upload() - APP/Controller/DocumentosController.php, line 145
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3acd6-trace').style.display = (document.getElementById('cakeErr4f4d957d3acd6-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: Invalid argument supplied for foreach() [<b>APP/Controller/DocumentosController.php</b>, line <b>186</b>]<div id="cakeErr4f4d957d3acd6-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3acd6-code').style.display = (document.getElementById('cakeErr4f4d957d3acd6-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3acd6-context').style.display = (document.getElementById('cakeErr4f4d957d3acd6-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d3acd6-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($formData&nbsp;as&nbsp;$file)&nbsp;{</span></code></span></pre><pre id="cakeErr4f4d957d3acd6-context" class="cake-context" style="display: none;">$folder	=	"files"
$formData	=	null
$item	=	null
$folderUrl	=	"/home/mue/Projects/php/sepi/public_html/files"
$relativeUrl	=	"files"
$allowedFileTypes	=	array(
	"application/pdf"
)</pre><pre class="stack-trace">DocumentosController::uploadFile() - APP/Controller/DocumentosController.php, line 186
DocumentosController::upload() - APP/Controller/DocumentosController.php, line 145
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3b3af-trace').style.display = (document.getElementById('cakeErr4f4d957d3b3af-trace').style.display == 'none' ? '' : 'none');"><b>Notice</b> (8)</a>: Undefined variable: result [<b>APP/Controller/DocumentosController.php</b>, line <b>239</b>]<div id="cakeErr4f4d957d3b3af-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3b3af-code').style.display = (document.getElementById('cakeErr4f4d957d3b3af-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3b3af-context').style.display = (document.getElementById('cakeErr4f4d957d3b3af-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d3b3af-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$result;&nbsp;</span></code></span></pre><pre id="cakeErr4f4d957d3b3af-context" class="cake-context" style="display: none;">$folder	=	"files"
$formData	=	null
$item	=	null
$folderUrl	=	"/home/mue/Projects/php/sepi/public_html/files"
$relativeUrl	=	"files"
$allowedFileTypes	=	array(
	"application/pdf"
)</pre><pre class="stack-trace">DocumentosController::uploadFile() - APP/Controller/DocumentosController.php, line 239
DocumentosController::upload() - APP/Controller/DocumentosController.php, line 145
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3ba53-trace').style.display = (document.getElementById('cakeErr4f4d957d3ba53-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: array_key_exists() expects parameter 2 to be array, null given [<b>APP/Controller/DocumentosController.php</b>, line <b>148</b>]<div id="cakeErr4f4d957d3ba53-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3ba53-code').style.display = (document.getElementById('cakeErr4f4d957d3ba53-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3ba53-context').style.display = (document.getElementById('cakeErr4f4d957d3ba53-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d3ba53-context" class="cake-context" style="display: none;">$results	=	null</pre><pre class="stack-trace">array_key_exists - [internal], line ??
DocumentosController::upload() - APP/Controller/DocumentosController.php, line 148
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3c16c-trace').style.display = (document.getElementById('cakeErr4f4d957d3c16c-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: array_key_exists() expects parameter 2 to be array, null given [<b>APP/Controller/DocumentosController.php</b>, line <b>148</b>]<div id="cakeErr4f4d957d3c16c-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3c16c-code').style.display = (document.getElementById('cakeErr4f4d957d3c16c-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d3c16c-context').style.display = (document.getElementById('cakeErr4f4d957d3c16c-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d3c16c-context" class="cake-context" style="display: none;">$results	=	null</pre><pre class="stack-trace">array_key_exists - [internal], line ??
DocumentosController::upload() - APP/Controller/DocumentosController.php, line 148
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d40d2e-trace').style.display = (document.getElementById('cakeErr4f4d957d40d2e-trace').style.display == 'none' ? '' : 'none');"><b>Notice</b> (8)</a>: Undefined index: Documento [<b>APP/Controller/DocumentosController.php</b>, line <b>150</b>]<div id="cakeErr4f4d957d40d2e-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d40d2e-code').style.display = (document.getElementById('cakeErr4f4d957d40d2e-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d40d2e-context').style.display = (document.getElementById('cakeErr4f4d957d40d2e-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d40d2e-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!(array_key_exists('errors',&nbsp;$results)&nbsp;||&nbsp;array_key_exists('nofiles',&nbsp;$results)))&nbsp;{</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;Documento-&gt;create();</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;$this-&gt;request-&gt;data['Documento']['submittedfile'];</span></code></span></pre><pre id="cakeErr4f4d957d40d2e-context" class="cake-context" style="display: none;">$results	=	null</pre><pre class="stack-trace">DocumentosController::upload() - APP/Controller/DocumentosController.php, line 150
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d41562-trace').style.display = (document.getElementById('cakeErr4f4d957d41562-trace').style.display == 'none' ? '' : 'none');"><b>Notice</b> (8)</a>: Undefined index: name [<b>APP/Controller/DocumentosController.php</b>, line <b>152</b>]<div id="cakeErr4f4d957d41562-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d41562-code').style.display = (document.getElementById('cakeErr4f4d957d41562-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr4f4d957d41562-context').style.display = (document.getElementById('cakeErr4f4d957d41562-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr4f4d957d41562-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;$this-&gt;request-&gt;data['Documento']['submittedfile'];</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data['user_id']&nbsp;=&nbsp;$this-&gt;Auth-&gt;user('id');</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data['url']&nbsp;=&nbsp;'files/'&nbsp;.&nbsp;$data['name'];</span></code></span></pre><pre id="cakeErr4f4d957d41562-context" class="cake-context" style="display: none;">$results	=	null
$data	=	array(
	"user_id" => "3"
)</pre><pre class="stack-trace">DocumentosController::upload() - APP/Controller/DocumentosController.php, line 152
ReflectionMethod::invokeArgs() - [internal], line ??
Controller::invokeAction() - CORE/Cake/Controller/Controller.php, line 473
Dispatcher::_invoke() - CORE/Cake/Routing/Dispatcher.php, line 104
Dispatcher::dispatch() - CORE/Cake/Routing/Dispatcher.php, line 86
[main] - ROOT/public_html/index.php, line 97</pre></div></pre><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>
        Sección de Estudios de Posgrado e Investigación: Documentos    </title>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="/favicon.ico" type="image/x-icon" rel="icon" /><link href="/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/jquery.fileupload-ui.css" />
	<link rel="stylesheet" type="text/css" href="/css/flick/jquery-ui-1.8.17.custom.css" />
</head>
<body>
    
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a href="/pages/welcome" class="brand">SEPI</a>                <ul class="nav ">
<li><a href="/">Inicio</a></li>
<li class="active"><a href="/dashboard">Dashboard</a></li>
<li><a href="/acerca">Acerca</a></li>
<li><a href="/contacto">Contacto</a></li></ul>
<ul class="nav right">
<li><a href="/dashboard">mue</a></li>
<li><a href="/logout">Cerrar Sesión</a></li></ul>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
        <li class="nav-header"><a href="/admin/users">Usuarios</a></li>
    <li><a href="#">Link</a></li>
    <li class="nav-header"><a href="/admin/contenidos">Contenidos</a></li>
    <li><a href="#">Link</a></li>
         <li class="nav-header">
        <a href="/admin/becas">Becas</a>    </li>
    <li><a href="#">Informaci&oacuten</a></li>
    <li class="nav-header"><a href="/convocatorias">Convocatorias</a></li>
</ul>                </div>
            </div>
            <div class="span10">
                                <div id="dashboard" class="content">
                    <header>
                        <ul class="nav nav-tabs">
<li><a href="/dashboard">Inicio</a></li>
<li><a href="/admin/users">Usuarios</a></li>
<li><a href="/admin/becas">Becas</a></li>
<li class="active"><a href="/admin/documentos">Documentos</a></li>
<li><a href="/admin/contenidos">Contenidos</a></li>
<li><a href="/admin/notas">Notas</a></li></ul>
                        <div class="breadcrumb">
                            <ul><li><a href="/admin/dashboard">Inicio</a><span class="divider">/</span></li><li><a href="/admin/documentos">Documentos</a><span class="divider">/</span></li><li><a href="/documentos/upload">Subir archivo</a><span class="divider">/</span></li></ul><!--<ul class="breadcrumb">
    <li><a></a><span class="divider">/</span></li>
    <li><a>hola</a><span class="divider">/</span></li>
    <li><a>hola</a><span class="divider">/</span></li>
</ul>-->                        </div>
                    </header>
                    <div class="documentos content">
    <div class="alert alert-error fade in" data-alert="alert">
    <a class="close" href="#" data-dismiss="alert">×</a>
    No se han podido guardar los datos.</div>    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
                <td class="preview"><span class="fade"></span></td>
                <td class="name">{%=file.name%}</td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                {% if (file.error) { %}
                    <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                {% } else if (o.files.valid && !i) { %}
                    <td>
                        <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                    </td>
                    <td class="start">{% if (!o.options.autoUpload) { %}
                        <button class="btn btn-primary">
                            <i class="icon-upload icon-white"></i> {%=locale.fileupload.start%}
                        </button>
                    {% } %}</td>
                {% } else { %}
                    <td colspan="2"></td>
                {% } %}
                <td class="cancel">{% if (!i) { %}
                    <button class="btn btn-warning">
                        <i class="icon-ban-circle icon-white"></i> {%=locale.fileupload.cancel%}
                    </button>
                {% } %}</td>
            </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                {% if (file.error) { %}
                    <td></td>
                    <td class="name">{%=file.name%}</td>
                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                    <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                {% } else { %}
                    <td class="preview">{% if (file.thumbnail_url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
                    {% } %}</td>
                    <td class="name">
                        <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                    </td>
                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                    <td colspan="2"></td>
                {% } %}
                <td class="delete">
                    <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                        <i class="icon-trash icon-white"></i> {%=locale.fileupload.destroy%}
                    </button>
                    <input type="checkbox" name="delete" value="1">
                </td>
            </tr>
        {% } %}
    </script>
    <div class="well form">
        <div id="demo1"></div>
    </div>
</div>                </div>
                <hr />
            </div>
        </div>
    </div>
    <footer>
                <div class="alert debug fade in sql_alert">
        <a class="close" href="#" data-dismiss="alert">×</a>
        <table class="cake-sql-log" id="cakeSqlLog_13304846054f4d957d46bcb8_29752232" summary="Cake SQL Log" cellspacing="0" border = "0"><caption>(default) 0 query took  ms</caption>	<thead>
		<tr><th>Nr</th><th>Query</th><th>Error</th><th>Affected</th><th>Num. rows</th><th>Took (ms)</th></tr>
	</thead>
	<tbody>
		</tbody></table>
	    </div>
            <p>Av. Juan de Dios Bátiz S/N. Casi esquina Miguel Othón de Mendizábal, 
        Unidad Profesional, Adolfo López Mateos. Colonia, Lindavista; Código Postal, 07738
        Delegación Gustavo A. Madero; México, D.F. Teléfono: 57-29-60-00 Extensión: 52028</p><a href="http://www.cakephp.org/" target="_blank"><img src="/img/cake.power.gif" alt="CakePHP" border="0" /></a>        </footer>
    
	<script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="/js/bootstrap-alerts.js"></script>
	<script type="text/javascript" src="/js/bootstrap-tabs.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ui.datepicker-es.js"></script>
	<script type="text/javascript" src="/js/sepi.js"></script>
</body>
</html>
