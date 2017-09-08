<?php
/**
 * <p>Plugin to generate an iframe element.</p>
 */
class PluginElementIframe_v1{
  /**
   * <p>Set attributes like any element. Use wrap to wrapping the iframe inside other element. Replace 4by3 to 16by9 if needed. Use the reload param for automatic reloading the content.</p>
   * <p>CSS classes in use is from Bootstrap.</p>
   */
  public static function widget_iframe($data){
    wfPlugin::includeonce('wf/array');
    $data = new PluginWfArray($data);
    $element = array();
    /**
     * id
     * Generate if not exist.
     */
    $id = $data->get('data/attribute/id');
    if(!$id){
      $id = wfCrypt::getUid();
      $data->set('data/attribute/id', $id);
    }
    /**
     * The iframe element.
     */
    $iframe = wfDocument::createHtmlElement('iframe', null, $data->get('data/attribute'));
    /**
     * iframe could be wrapped.
     */
    if($data->get('data/wrap/enabled')){
      $wrap_element = new PluginWfArray($data->get('data/wrap/element'));
      $wrap_element->set('innerHTML', array($iframe));
      $element[] = $wrap_element->get();
    }else{
      $element[] = $iframe;      
    }
    /**
     * Automatic reloading the iframe.
     */
    if($data->get('data/reload/enabled')){
      $secounds = $data->get('data/reload/seconds');
      if(!$secounds){
        $secounds = '5000';
      }else{
        $secounds = $data->get('data/reload/seconds').'000';
      }
      $script = <<<SCRIPT
        var plugin_element_iframe_count_$id = 0;
        function plugin_element_iframe_method_$id(){
          if(plugin_element_iframe_count_$id > 0){
            document.getElementById('$id').contentWindow.location.reload();
          }
          plugin_element_iframe_count_$id++;
          setTimeout("plugin_element_iframe_method_$id()", $secounds);
        }
        plugin_element_iframe_method_$id();
SCRIPT;
      $element[] = wfDocument::createHtmlElement('script', $script);
    }
    wfDocument::renderElement($element);
  }
}