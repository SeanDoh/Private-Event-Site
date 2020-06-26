<!DOCTYPE html>

<html lang="$ContentLocale">
<head>
  <% base_tag %>
  <title>$SiteConfig.Title</title>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet"> 
  <% require themedCSS('styles') %>
  <% require themedCSS('animate.min') %>
  <% require javascript("public/javascript/index.js") %>
</head>
<body style="background-image: url($SiteConfig.Image.URL)">
  $CheckAccess()
  <div class="animated fadeIn" id="root">
    $Layout
  </div>
</body>
</html>