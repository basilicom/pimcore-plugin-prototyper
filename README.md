Prototyper Pimcore Plugin
================================================

Developer info: [Pimcore at basilicom](http://basilicom.de/en/pimcore)

## Synopsis

This Pimcore http://www.pimcore.org plugin simplifies creating
object classes via simple CSV data. The first row is used for the
field labels and - transliterated - for the field names. All
fields are set up as simple varchar(100) text inputs.

## Code Example / Method of Operation

If installed and enabled, use the plugin "configuration" link
from the extensions screen to create a new class.

How to create a new class from a CSV file:

* Enter a name for the new object class in the first field.
* Prepare CSV data. Be sure to include a 1st row with human readable header fields.
* Copy and paste the CSV data (newline, UTF-8, separated by ';') into the textarea field.
* Press "Preview CSV Data".
* Review the Table view - 1st row will be the field titles, 2nd row the field names.
* Press "Generate Object Class" to create or update the object class.
* Further steps: Use the object class editor to change the field types according to your needs.

## Motivation

New Pimcore projects often start with existing data sets of exports.
Setting up the data types, aka object classes can be a tedious task,
if many fields are involved. This plugin accelerates rapid class
prototyping by using CSV data to create object classes.

## Installation

Add "basilicom-pimcore-plugin/prototyper" as a requirement to the
composer.json in the toplevel directory of your Pimcore installation.

Example:

    {
        "require": {
            "basilicom-pimcore-plugin/prototyper": "^1.0.0"
        }
    }
    
Install the plugin via the Pimcore Extension Manager. Press the "Configure" button of the
Plugin from within the Extension Manager to start prototyping a new object class.

## API Reference

The following templates are used to create JSON object class definitions:
 
* /classes/field.json.php
* /classes/object.json.php

Caveats:

* too many fields might cause a MySQL row size limit error. Reduce varchar size in field.json.php to compensate.

## Tests

* none

## Todo

* Basic validation of CSV data, error messages
* Allow field type changes prior to class generation

## Contributors

* Christoph Luehr <christoph.luehr@basilicom.de>

## License

* BSD-3-Clause, see LICENSE.txt
