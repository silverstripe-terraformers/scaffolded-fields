# Scaffolded fields

Configure which scaffolded fields are kept and which are removed.

## Overview

SilverStripe CMS creates CMS fields out of the box for you which is great for a quick project start up as you don't have to do anything to define your CMS fields.
This is covered by the field scaffolder which generates these scaffolded fields.
Many projects however, will use customised CMS fields which do not need the scaffolded fields.
On the contrary. scaffolded fields are often a hindrance.

### Most notable cases

* inserting new fields to specific position
* changing the order of scaffolded
* changing the hierarchy of scaffolded

### Conclusion

* customising scaffolded fields takes more effort compared to defining them from scratch
* customising order of the scaffolded fields takes more effort compared to defining it from scratch

In such situations, it's preferable to simply remove scaffolded fields and redefine them in your project code.
This approach makes the CMS fields definition more readable as all fields are defined in one place.
Project code is also easier to maintain as you don't have to support code which looks up scaffolded fields so they could be customised or reordered.

## Installation

```
composer require silverstripe-terraformers/scaffolded-fields dev-master
```

* apply `Terraformers\ScaffoldedFields\Extension` to a data object of your choice
* provide field removal configuration

## Configuration

Specify which fields need to be kept and which should be removed. Configuration is a collection of rules.
Each rule consists of the following:
 
* property (`db`, `has_one`, `has_many`, `many_many` or `extra`)
* type (`keep` or `remove`), this is not required when `extra` property is used
* fields list of field names that the configuration applies to

#### Example configuration

```yml
DNADesign\Elemental\Models\BaseElement:
  extensions:
    - Terraformers\ScaffoldedFields\Extension
  field_removal:
    - # remove all db fields except Title and ShowTitle
      property: db
      type: keep
      fields:
        Title
        ShowTitle
    - # remove all has_one fields
      property: has_one
      type: keep
    - # remove LinkTracking, FileTracking and BackLinkTracking fields from many_many
      property: many_many
      type: remove
      fields:
        LinkTracking
        FileTracking
        BackLinkTracking
    - # remove Settings field (not part of any static property)
      property: extra
      fields:
        Settings
```
