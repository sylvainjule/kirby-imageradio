# Imageradio - Kirby illustrated radio

This field allows you to add illustrations to radio buttons. Suggestions welcome.

![illustrated-radio](https://user-images.githubusercontent.com/14079751/28130554-5edcff2e-6737-11e7-8714-1a82299ede4e.jpg)

## Installation
Put this field in the `site/fields` directory.  
The field folder must be named `imageradio` :

```
|-- site/fields/
    |-- imageradio/
        |-- assets/
        |-- imageradio.php
```

## Usage

Basic usage in blueprint:

```yaml
  fieldname:
    label: Field label
    type: imageradio
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

By default, images must be put in the main `assets/images` folder of your website.

## Options

Other options are not required. 

### Custom ratio

If `ratio` is specified, images will be displayed as background images and the ratio set for its container. You can then set the background position with a CSS syntax (not mandatory, default position is : `center center`).

```yaml
  fieldname:
    label: Field label
    type: imageradio
    columns: 3
    display:
      ratio: 3/2
      position: top left
    options:
      (...)
```

### Enable for mobiles

By default, images are not displayed when the panel switches to its mobile view. If you want to override this, set :

```yaml
    display:
      mobile: true
```

### Fetch images

You can query images from existing pages to populate the buttons.

Please note that `fetch` **must** be set to `images` in order for this to work properly.

The appropriate syntax is then :

```yaml
  fieldname:
    label: Field label
    type: imageradio
    columns: 3
    options: query
    query:
      page: path/to/page
      fetch: images
      value: '{{filename}}'
      text: 
        label: '{{filename}}'
        image: '{{filename}}'
```

### Use color instead of image

You can choose to use a background-color instead of an image. In this case, `ratio` should be specified (fallback is 4/1).

```yaml
fieldname:
    label: Field label
    type: imageradio
    columns: 2
    display:
      ratio: 5/1
    options:
      light:
        label: Light theme
        color: '#f0f0f0'
      dark:
        label: Dark theme
        color: '#0f0f0f'
```



## License

MIT