# Laravel dashboard kit Media <!-- omit in toc -->

## Table of content <!-- omit in toc -->

- [Installation](#installation)
- [Before usage](#before-usage)
  - [Create the media table](#create-the-media-table)
  - [Use `HasMedia` trait](#use-hasmedia-trait)
  - [`Media` model methods](#media-model-methods)
- [Roadmap](#roadmap)

## Installation

```sh
composer require laravel-dashboard-kit/media
```

## Before usage

### Create the media table

```sh
php artisan migrate
```

### Use `HasMedia` trait

Use `LDK\Media\Models\Behaviors\HasMedia` trait with your model. You will have access to following methods:

- `medias()`: Morph relationship. Returns multiple Media records
- `media()`: Morph relationship. Returns last Media record. You need to use this when your model linked to only single media
- `single('type')`: Get first media that has given type
- `multiple('type')`: Get medias that have given type
- `$model->media_url`: A quick getter to **latest** Media url
- `$model->media_urls`: A quick getter to all Media urls. Returns array

### `Media` model methods

- `mediable()`: Morph relationship to linked model
- `$media->file_url`: Returns the url based on stored file name and storage
- `$media->file_path`: Returns the path based on stored file name and storage
- `$media->base64`: Encode media content to base64

## Roadmap

- [ ] Helper methods
- [ ] Doc usage
