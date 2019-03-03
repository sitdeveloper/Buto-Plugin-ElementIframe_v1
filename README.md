# Buto-Plugin-ElementIframe_v1

Widget to render iframe element with auto refresh.




```
type: widget
data:
  plugin: element/iframe
  method: iframe
  data:
    attribute:
      src: /doc/test
      class: 'embed-responsive-item'
      style: 'height:600px'
      name: plugin_element_iframe
    wrap:
      enabled: true
      element:
        type: div
        attribute:
          class: 'embed-responsive embed-responsive-4by3'
    reload:
      enabled: true
      seconds: 10
```



