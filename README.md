# Kirby illustrated radios

Add illustrations to radio buttons.

![cover](https://user-images.githubusercontent.com/14079751/48334055-a769b280-e659-11e8-828a-09aad54ddd9f.jpg)

<br/>

## Overview

> This plugin is completely free and published under the MIT license. However, if you are using it in a commercial project and want to help me keep up with maintenance, please consider [making a donation of your choice](https://www.paypal.me/sylvainjule) or purchasing your license(s) through [my affiliate link](https://a.paddle.com/v2/click/1129/36369?link=1170).

- [1. Installation](#1-installation)
- [2. Setup](#2-setup)
  * [2.1. Hardcoded options](#21-hardcoded-options)
  * [2.2. Dynamic options](#22-dynamic-options)
- [3. Options](#3-options)
- [4. License](#4-license)

<br/>

## 1. Installation

> If you are looking to use this field with Kirby 2, please switch to the `kirby-2` branch.

Download and copy this repository to ```/site/plugins/imageradio```

Alternatively, you can install it with composer: ```composer require sylvainjule/imageradio```

<br/>

## 2. Setup

The field is best used with the `columns` option set.

#### 2.1. Hardcoded options

If the field's options are hardcoded, images need to be placed in the `assets/images` folder of your installation.

The `image` value must be a filename, the field will automatically prefix it with the correct path.

```yaml
myimageradio:
  label: Pick a theme
  type: imageradio
  columns: 3
  options:
    light:
      text: Light theme
      image: light.jpg
    dark:
      text: Dark theme
      image: dark.jpg
    blue:
      text: Blue theme
      image: blue.jpg
```

#### 2.2. Dynamic options

The field is compatible with both `query` and `api` fetch. You need to explicitely set the result text, stored value and image url.

The `image` value must return **an absolute url**.

```yaml
myimageradio:
  label: Pick a theme
  type: imageradio
  columns: 3
  options: query
  query:
    fetch: page.images
    text: "{{ file.filename }}"
    value: "{{ file.id }}"
    image: "{{ file.resize(512).url }}"
```

Notice the `{{ file.resize(512).url }}` instead of `{{ file.url }}`. Two reasons for this:

- Using a thumb url will prevent loading unnecessarily large images.
- `512` is the default value of the Files field's thumbs. Therefore it is likely that the thumb will have already been created. 

I recommend using a `resize` number [already used](https://github.com/k-next/kirby/blob/a709a5728671c0b85a1f37db1d6b2a028151f013/config/api/models/File.php#L86) by the panel (128, 256, 512, 768, 1024).

<br/>

## 3. Options

#### 3.1. `ratio`

![ratio](https://user-images.githubusercontent.com/14079751/48334059-a769b280-e659-11e8-8195-9aa68da30091.jpg)

The ratio of the image container, to be adjusted depending on your images. Default is `1/1`.

```yaml
myimageradio:
  type: imageradio
  ratio: 1/1
```

#### 3.2. `fit`

![fit](https://user-images.githubusercontent.com/14079751/48334056-a769b280-e659-11e8-897a-53e371c22026.jpg)

Defines how the image should fit within its container, either `contain` or `cover`. Default is `cover`.

```yaml
myimageradio:
  type: imageradio
  fit: cover
```

#### 3.3. `mobile`

By default, images are not displayed when the panel switches to its mobile view. Not recommended, but if you want to override this, set the option to `true`.

```yaml
myimageradio:
  type: imageradio
  mobile: false
```

#### 3.4. `gap`

![gap](https://user-images.githubusercontent.com/14079751/48334057-a769b280-e659-11e8-95f8-175cbee67088.jpg)

Whether the field should have a `1rem` gap between each input, K2-like. Default is `false`.

```yaml
myimageradio:
  type: imageradio
  gap: false
```

<br/>

## 4. License

MIT