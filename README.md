# Simple Content Elements (SCE)

Adds content elements like a text-, image or text & image element to a page or dataobject.
The target of this module is to gain more control over the layout and styling of content.

### Usage with pages
Simply add the extension to the desired page type

```yaml
MyPage:
  extensions:
    - SCEExtension
```

### Usage with dataobjects
Again, add the extension to your dataobject

```yaml
MyObject:
  extensions:
    - SCEExtension
```

After that you need to extend ``SCEElement`` and add a ``has_one`` relation to your dataobject

```php
private static $has_one = [
  'MyObject' => 'MyObject',
];
```

### Templating
By default simply include this

```
<% include SimpleContentElements %>
```

All content elements are rendered with a template named like their class.
In those templates you could include ``SCEHeader`` and ``SCEFooter`` at the beginning and end.
Those includes contain a default wrapper and take care of the title logic (display or not, that's the question)

### Options
You could set the following inside your yaml config.

**Remove the html editor content field if sce is used**
```yaml
SCEExtension:
  remove_content_field: true
```

**Define image size and mode**
```yaml
SCEImage:
  image_width: 400
  image_height: 300
  image_mode: 'FocusFill'
SCETextImage:
  image_width: 400
  image_height: 300
  image_mode: 'FocusFill'
SCEDescribedImages_Image:
  image_width: 400
  image_height: 300
  image_mode: 'FocusFill'
```

### Extending / Your own elements
TBD

### Todo
- [ ] Permissions
- [ ] Versioning
- [ ] Fluent
- [ ] Default CSS / SCSS
- [ ] SS4 support