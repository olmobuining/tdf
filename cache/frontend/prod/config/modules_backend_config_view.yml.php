<?php
// auto-generated by sfViewConfigHandler
// date: 2012/06/16 22:02:43
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'indexSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'newBlogSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'imageUploadSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'editBlogSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'newTagSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'attachTagSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'attachImageTypeSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'attachImageAlbumSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'attachTagImageSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'activateUserSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'userSuccess')
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
  $response->addStylesheet('related.css', '', array ());
  $response->addStylesheet('aside.css', '', array ());
  $response->addJavascript('cufon-yui.js', '', array ());
  $response->addJavascript('ringbearer.font.js', '', array ());
  $response->addJavascript('cufon.declare.js', '', array ());
  $response->addJavascript('fixhtml5.js', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', array ());
}
else if ($templateName.$this->viewName == 'newBlogSuccess')
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
else if ($templateName.$this->viewName == 'imageUploadSuccess')
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
else if ($templateName.$this->viewName == 'editBlogSuccess')
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
  $response->addJavascript('tiny_mce/tiny_mce.js', '', array ());
}
else if ($templateName.$this->viewName == 'newTagSuccess')
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
else if ($templateName.$this->viewName == 'attachTagSuccess')
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
else if ($templateName.$this->viewName == 'attachImageTypeSuccess')
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
else if ($templateName.$this->viewName == 'attachImageAlbumSuccess')
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
else if ($templateName.$this->viewName == 'attachTagImageSuccess')
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
else if ($templateName.$this->viewName == 'activateUserSuccess')
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
else if ($templateName.$this->viewName == 'userSuccess')
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
  $response->addStylesheet('related.css', '', array ());
  $response->addStylesheet('aside.css', '', array ());
  $response->addJavascript('cufon-yui.js', '', array ());
  $response->addJavascript('ringbearer.font.js', '', array ());
  $response->addJavascript('cufon.declare.js', '', array ());
  $response->addJavascript('fixhtml5.js', '', array (  'condition' => 'lt IE 9',));
  $response->addJavascript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', array ());
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

