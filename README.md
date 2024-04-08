# TYPO3 Surfcamp – Public Sector Intranet
Note: This Git repository was created by the participants of team 5 during the TYPO3 Surfcamp 2024 (https://surfcamp.typo3.com/). This team consists of the following particpants:
Susi Moog (Mentor), Oliver Bartsch (Backend Development), Kirk Kleinau (Frontend Development), Fjora Hodo (Fullstack Development), Filippos Karpouchtsis (Frontend Development) and Luisa Faßbender (Content & Marketing). 

## Purpose and Intended Usage
With this preset, users can set up a new intranet-like solution with ease – with a specific focus on the requirements of the public sector. 
By downloading and installing this preset, users receive:
* a predefined pagetree with a set of pages,
* basic content elements with example content for quick and easy adoption,
* a defined folder structure within the fileadmin – corresponding with the pagetree structure,
* established backend user groups and corresponding test users with granularly defined access rights.

## Basic Information
The project is based on the current development branch of TYPO3 v13.x, using Composer. The configuration happens via
`.env` thanks to the underlying package `vlucas/phpdotenv`.

Deploying the project is triggered by pushed onto the `main` branch via Github Actions, which triggers a Magallanes
workflow that does the actual heavy work. Please note that the configuration needs adaption **per team-based** repository.

## Requirements

* having Docker installed locally (see https://docs.docker.com/get-docker/)
* having DDEV installed locally (see https://ddev.readthedocs.io/en/stable/#installation)


## Initialization

```sh
ddev start
ddev composer install
```

### Downloading database and files

Databases and files are synchronized every 10 minutes into
https://github.com/TYPO3incubator/surfcamp-assets and can be downloaded via:

```sh
ddev auth ssh
# HEADS UP: All files in the local `public/fileadmin/` will be overridden, that means:
# all files that are not present on the surfcamp team vhost will be deleted from fileadmin
ddev pull assets
```

### Contributing to the TYPO3 Core

In case the team decides to, or needs to contribute to the TYPO3 core, this project can be "upgraded".

```sh
git clone git@github.com:TYPO3/typo3.git typo3_core
ddev composer config repositories.typo3_core --json '{"type": "path", "url": "typo3_core/typo3/sysext/*"}'
ddev composer update 'typo3/cms-*' -W
```

The commands above clone TYPO3 core source to the directory `./typo3_core/`, configure
a corresponding local composer-path-repository using that directory and finally
update the sources in `./vendor/` (TYPO3 specific packages will be symlinked).

Further details are mentioned in the [TYPO3 Contribution Guide](https://docs.typo3.org/m/typo3/guide-contributionworkflow/main/en-us/Index.html),
more specifically in the [Git Setup](https://docs.typo3.org/m/typo3/guide-contributionworkflow/main/en-us/Setup/Git/Index.html) section of that guide.
