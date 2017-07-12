# Kirby Illustrated radio

This field allows you to add illustrations to radio buttons.
Advices and suggestions welcome.



## Installation
Put this field in the `site/fields` directory.  
The field folder must be named `illustratedradio` :

```
site/fields/
    illustratedradio/
        illustratedradio.php
        ...
```

## Usage

Basic usage in blueprint:
```yaml
  fieldname:
    label: Field label
    type: illustratedradio
    columns: 3
    options: 
      light:
        label: Light theme
        image: light.jpg
      dark:
        label: Dark theme
        image: dark.jpg
      blue:
        label: Blue theme
        image: blue.jpg
```

Images must be put in the main `assets/images` folder of your website.

Other options are not required. 

If ratio is specified, images will be displayed as background images and the ratio set for its container. You can then set the background position with a CSS syntax (default position is : `center center`).
```yaml
  fieldname:
    (...)
    ratio: 3/2
    position: top left
    options:
      (...)
```

Images are not displayed when the panel switches to its mobile view. If you want to override this, set :
```yaml
    mobile: true
```
