<!DOCTYPE html>
<html class="no-js" lang="{$ContentLocale}">
<head>
<% include HeaderMeta %>
</head>
<body class="{$ClassName} {$SliderClass}"{$Background} id="{$URLSegment}">
    {$TrackingCodeTop.RAW}
    <% include Header %>
    <section id="mainContent">
        {$Layout}
    </section><!-- /#mainContent -->
    <% include Footer %>
    {$TrackingCodeBottom.RAW}
</body>
</html>