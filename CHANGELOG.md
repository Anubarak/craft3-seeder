# Craft Seeder Changelog

## 3.1.0 - Unreleased
### Added
- Added `eachMatrixBlock` option, to seed a matrix with one of each blocktype in a random order ([#13](https://github.com/studioespresso/craft3-seeder/issues/13))
- Added`useLocalAssets` option, to seed asset fields with assets from a specified volume & folder, to be used in case you have your own set of test images.
- Added support for [rias/craft-position-fieldtype](https://github.com/Rias500/craft-position-fieldtype)
## 3.0.1 - 2019-04-09

### Added
- Progress bars when generating elements ([#4](https://github.com/studioespresso/craft3-seeder/issues/4))

### Fixed
- Fixed an issue with seeding categories ([#8](https://github.com/studioespresso/craft3-seeder/issues/8))
- Fixed an issue with seeding entries for sections without fields

## 3.0.0 - 2019-02-05

### Added
- Seeder now works with Craft 3.1 🎉
- Added support for [statikbe/craft-cta-field](https://github.com/statikbe/craft3-ctafield)
### Fixed
- Fixed asset fields in Craft 3.1
- Fixed an issue where seeding a Supertable field in a Matrix field would crash
- Fixed an issue with minimum & maximum number of blocks on a Supertable field

## 2.1.0 - 2018-09-19

### Added
- Added support for fields on Users
- Added support for fields on Categories

## 2.0.0 - 2018-08-24
### Changed
- The commands now take named parameters in stead of just IDs
- The commands now also work with section/group handle or with section/group id
### Added
- Supertable support, Super table static field support and all core fields in a Supertable field

## 1.0.3 - 2018-05-29
### Fixed
- Fixes an issues with min/max rows in table fields (issue #3)

## 1.0.2 - 2018-05-24
### Fixed
- Fixed an issue with asset fields that did not have a limit set. Now we'll seed a random number of images between 1 and 5 for those.

## 1.0.1 - 2018-05-23
### Changed
- Seeded images are now smaller (1600x1200), which are served more reliable from lorempixel.com

## 1.0.0 - 2018-05-16
### Added
- Initial release
