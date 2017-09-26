# BMD Blog

![status-dev](https://img.shields.io/badge/status-dev-yellow.svg) ![version-0-1-0](https://img.shields.io/badge/version-0.1.0-blue.svg)

Yet another minimalistic markdown blogging platform with category and search support.

[DEMO](http://bmd.beremaran.com/getting-started-with-bmd-blog)

## Getting Started

### Installation

1. Download or clone this repository
2. Run `composer update` before uploading on your computer or remote server after upload
3. Upload to your server
4. That's it.

### Settings
You change settings by editing `core/settings.php`.

```
    ...

    'settings' => [

        'blogTitle' => 'MdBlog Documentation',
        'site_url' => 'http://localhost:8888',
        'template' => 'bootstrap',
        'default_category' => 'General',

        'template_dir' => 'templates',

    ...
```

### Create / Edit / Delete Authors
Authors stored as `JSON` files in `authors` folder as default.

```
{
  "nickname": "beremaran",
  "fullName": "Berke Emrecan Arslan",
  "twitter": "beremaran",
  "email": "berke@beremaran.com"
}
```

#### Warning for before `1.1.0` contributors
* `password` field is reserved for future use.

### Create / Edit / Delete Posts
Posts stored as `Markdown (*.md)` files in `posts` folder as default. Meta information of posts stored in the beginning of `Markdown` file.

#### Post-Meta Layout
```
AUTHOR_NICKNAME, DD-MM-YYYY, [CATEGORY]
ONE_LINER_SHORT_TEXT
# POST_TITLE
```

If no category is specified, post will be listed under default category set in `settings.php`.

_Example_
```
beremaran, 26-09-2017
... because everything starts with `Hello, World!` ...
# Hello, World!
```

### Create a Template

TODO

## Contributing
* I won't be accepting pull requests until version 1.0.0
* Bug reports and feature requests can be delivered via GitHub Issue Tracker.

## Copyright & License
Code copyright 2017 - beremaran. Code released under MIT License.
