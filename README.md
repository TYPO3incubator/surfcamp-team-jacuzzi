# TYPO3 Surfcamp – Public Sector Intranet
Note: This Git repository was created by the participants of team 5 during the TYPO3 Surfcamp 2024 (https://surfcamp.typo3.com/).
This team consists of the following particpants:
* Susi Moog (Mentor),
* Oliver Bartsch (Backend Development),
* Kirk Kleinau (Frontend Development),
* Fjora Hodo (Fullstack Development),
* Filippos Karpouchtsis (Frontend Development),
* Luisa Faßbender (Content, PM & Marketing).

## Purpose and Intended Usage
With this preset, users can set up a new intranet-like solution with ease – with a specific focus on the requirements of the public sector.
By downloading and installing this preset, users receive:
* a predefined pagetree with a set of pages,
* basic content elements with example content for quick and easy adoption,
* a defined folder structure within the fileadmin – corresponding with the pagetree structure,
* established backend user groups and corresponding test users with granularly defined access rights.
* a mulitlingual setup with EN and "easy language" to adhere to governmental specifications

### Page Structure & Functionalities
The Public Sector Intranet Preset comes with the following page structure:

#### Home
On the homepage, the user receives a welcome message alongside an easy and quick submenu navigation option to help navigation throught the page.

#### News & Upcoming Events
This section displays any important announcements and upcoming institution events.

#### Organigram
This section displays the institutions structure and offers access to employee contact details, their positions and sorts the employees by departments.

#### Working Groups
This section displays the different working groups within the organization and is only accessible to those frontend users who already belong to one or mulitple of these groups.

#### Cafeteria & Meal Plans
This section enables an overview over the cantina opening hours and offers the weekly changing meal plans.

#### Document Search
The Document Search based on indexed_search enables an easy access to a variety of documents and document types. Users can enter their search terms, filter by document size, document type and upload date and receive a result list.

#### Personal Profile
Thsi section displays the frontend users information and offers the possibility to change personal information.

#### Contact & Help
This section offers contact information & info on where to get help when encountering issues with the intranet.

### Backend Users and User Groups
This preset comes with four predefined backend user groups for the following use cases:

#### Intranet Administrator
The intranet administrator receives extensive access to the TYPO3 backend in order to enable administrative tasks. Besides general content management functionalitites, this includes the creation and adminstration of all frontend users and user groups.

#### Cafeteria Manager
The cafeteria manager receives limited page tree access in order to offer an easy and structured way of the weekly meal plan exchange. This user resembles a "easy-access" user without distractions.

#### Content Editor
The content editor receives full content editing access and resembles the standard content manager in institutions.

#### HR Manager
Analogue to the cafeteria manager, the HR manager also receives limited editorial access rights to the backend. This user only receives access to manage and update the company's organigram.

### Frontend Users and User Groups
* Standard Access
* Internal Working Groups

--------------------------------------------

## Basic Information

This Git repository is intended for use by our dedicated teams at the [TYPO3 Surfcamp](https://surfcamp.typo3.com/). The configuration happens via `.env` thanks to the underlying package `vlucas/phpdotenv`.

## Requirements

* having Docker installed locally (see https://docs.docker.com/get-docker/)
* having DDEV installed locally (see https://ddev.readthedocs.io/en/stable/#installation)


## Initialization

```sh
ddev start
ddev composer install
```

## Credentials

- Backend: https://surfcamp-team3.ddev.site/typo3
- Username: `admin`
- Password: `John3:16`

### Downloading database and files

```sh
# HEADS UP: All files in the local `public/fileadmin/` will be overridden, that means:
# all files that are not present in `data/files/public/fileadmin/` will be deleted from fileadmin
ddev pull assets
```

### Update local database and files

```sh
# HEADS UP: All files in the local `data/files/public/fileadmin/` will be overridden, that means:
# all files that are not present in `public/fileadmin/` will be deleted from fileadmin
ddev push assets
```

### Assets compilation

Install gulp and dependencies:
```sh
ddev exec npm install
```
Compile assets with the following commands:
```sh
# compile styles
ddev exec gulp styles
# compile scripts
ddev exec gulp scripts
```
