<?php
// auto-generated by sfViewConfigHandler
// date: 2012/09/14 19:43:35
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'indexSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'newSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'indexSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'The Dutch Fellowship', false, false);
  $response->addMeta('description', 'Een Nederlandse Guild wars 2 guild.', false, false);
  $response->addMeta('keywords', 'Guild wars 2, guild, guildwars, guild wars, tdf, The Dutch Fellowship, Dutch guild, Nederlandse guild, Nederlands, clan, arena net, arena, ncsoft, nederland clan, nederlandse clan', false, false);
  $response->addMeta('language', 'nl', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('reset.css', '', array ());
  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('iefix.css', '', array (  'condition' => 'lt IE 9',));
  $response->addStylesheet('forms.css', '', array ());
  $response->addStylesheet('aside.css', '', array ());
  $response->addJavascript('cufon-yui.js', '', array ());
  $response->addJavascript('ringbearer.font.js', '', array ());
  $response->addJavascript('cufon.declare.js', '', array ());
  $response->addJavascript('fixhtml5.js', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', array ());
}
else if ($templateName.$this->viewName == 'newSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'The Dutch Fellowship', false, false);
  $response->addMeta('description', 'Een Nederlandse Guild wars 2 guild.', false, false);
  $response->addMeta('keywords', 'Guild wars 2, guild, guildwars, guild wars, tdf, The Dutch Fellowship, Dutch guild, Nederlandse guild, Nederlands, clan, arena net, arena, ncsoft, nederland clan, nederlandse clan', false, false);
  $response->addMeta('language', 'nl', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('reset.css', '', array ());
  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('iefix.css', '', array (  'condition' => 'lt IE 9',));
  $response->addStylesheet('forms.css', '', array ());
  $response->addStylesheet('aside.css', '', array ());
  $response->addStylesheet('jquery-ui-1.8.18.custom.css', '', array ());
  $response->addJavascript('cufon-yui.js', '', array ());
  $response->addJavascript('ringbearer.font.js', '', array ());
  $response->addJavascript('cufon.declare.js', '', array ());
  $response->addJavascript('fixhtml5.js', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.8.18.custom.min.js', '', array ());
}
else
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'The Dutch Fellowship', false, false);
  $response->addMeta('description', 'Een Nederlandse Guild wars 2 guild.', false, false);
  $response->addMeta('keywords', 'Guild wars 2, guild, guildwars, guild wars, tdf, The Dutch Fellowship, Dutch guild, Nederlandse guild, Nederlands, clan, arena net, arena, ncsoft, nederland clan, nederlandse clan', false, false);
  $response->addMeta('language', 'nl', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('reset.css', '', array ());
  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('iefix.css', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('cufon-yui.js', '', array ());
  $response->addJavascript('ringbearer.font.js', '', array ());
  $response->addJavascript('cufon.declare.js', '', array ());
  $response->addJavascript('fixhtml5.js', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', array ());
}

