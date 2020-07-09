<h1 align="center">MeiliSearch Dashboard</h1>

<h4 align="center">
  <a href="https://github.com/meilisearch/MeiliSearch">MeiliSearch</a> |
  <a href="https://www.meilisearch.com">Website</a> |
  <a href="https://blog.meilisearch.com">Blog</a> |
  <a href="https://twitter.com/meilisearch">Twitter</a> |
  <a href="https://docs.meilisearch.com">Documentation</a> |
  <a href="https://docs.meilisearch.com/faq">FAQ</a>
</h4>

<p align="center">
  <a href="https://github.com/meilisearch/meilisearch-laravel-scout/blob/master/LICENSE"><img src="https://img.shields.io/badge/license-MIT-informational" alt="License"></a>
  <a href="https://slack.meilisearch.com"><img src="https://img.shields.io/badge/slack-MeiliSearch-blue.svg?logo=slack" alt="Slack"></a>
</p>

<p align="center">⚡ Lightning Fast, Ultra Relevant, and Typo-Tolerant Search Engine MeiliSearch driver for Laravel Scout</p>

**MeiliSearch Dashboard** is a minimalist user interface to help you to configure your indexes.

**MeiliSearch** is a powerful, fast, open-source, easy to use and deploy search engine. Both searching and indexing are highly customizable. Features such as typo-tolerance, filters, and synonyms are provided out-of-the-box.

## Table of Contents

- [Disclaimer](#disclaimer)
- [Installation Docker](#installation-docker)
- [Installation Docker Compose](#installation-docker-compose)

### Disclaimer

The dashboard is in an early stage.
I have implemented the base functionalities of MeiliSearch, you might encounter some bugs, bad code design. A lot of improvement has to be made!
Do not hesitate to help me to improve the dashboard :)

The dashboard is build with:
- [Tailwindcss](https://tailwindcss.com/) & [TailwindUI](https://tailwindui.com)
- [Alpinejs](https://github.com/alpinejs/alpine)
- [Laravel](https://laravel.com)
- [Livewire](https://laravel-livewire.com/)

## Installation Docker

### Run Dashboard with Docker

```bash
$ docker network create meilisearch-network
```

```bash
$ docker run -it --rm -p 8000:80 --network=meilisearch-network shokme/meilisearch-dashboard:alpha
```

### Run MeiliSearch

There are many easy ways to [download and run a MeiliSearch instance](https://docs.meilisearch.com/guides/advanced_guides/installation.html#download-and-launch).

For example, if you use Docker:
```bash
$ docker run -it --rm -p 7700:7700 --network=meilisearch-network getmeili/meilisearch:latest ./meilisearch --master-key=masterKey
```

NB: you can also download MeiliSearch from **Homebrew** or **APT**.

### Connect the dashboard to an instance

```bash
docker ps
```
Copy the **CONTAINER ID** of getmeili/meilisearch.
On the dashboard homepage in the `host` field insert the container id followed by the port. Example: e194fad4790f:7700

## Installation Docker Compose

```
version: '3'
services:
    dashboard:
        image: shokme/meilisearch-dashboard:alpha
        ports:
        - 8000:80
    meilisearch:
        image: getmeili/meilisearch:latest
        ports:
        - 7700:7700
```

On the dashboard homepage in the `host` field insert the service name followed by the port. Example: meilisearch:7700 

<hr>

**MeiliSearch** provides and maintains many **SDKs and Integration tools** like this one. We want to provide everyone with an **amazing search experience for any kind of project**. If you want to contribute, make suggestions, or just know what's going on right now, visit us in the [integration-guides](https://github.com/meilisearch/integration-guides) repository.
