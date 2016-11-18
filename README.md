# JumpButton Studio API Documentation System
An open source API Documentation System.
With simple YAML file you can document your server-side API and have beautiful easy to read HTML page ready for the rest of your team.

##Requirements
PHP Server with **PHP_YAML** extension installed.

## Recent Updates

### Version 1.04
* Fixed nested array formatting
* Fixed bug with additional `,` at the end of an array
* Added the ability to comment each item in the success examples
* Added support for object type arrays
* Added support for empty arrays

### Version 1.03
* Removed last unnecessary `,` in success and failure examples.
* Added Array support in the success and failure examples.

### Version 1.02
* Added some fail safe checks (AKA Bug fixes on the function pages.)

### Version 1.01
* Modified the script so that you no longer need to define the return type of success and failures.
* Added script version number to the HTML title.
* Made a config.php file for easy configuration.
* Modified document.class.php to work in sub-folders ex: http://www.test.com/api_documentation/{SCRIPT_HERE}

##Usage
Simply edit the **example.yaml** file to your needs.
Each function is formatted like so.

```yaml
  -
    name: "Example_Function"
    url: "?action=example_function"
    parameters:
      get: 
        -
          name: "parameter_name"
          description: "A brief description of what the parameter is for."
          type: "String"
      post:
        -
          name: "posted_parameter"
          description: "A posted parameter instead of a get parameter."
          type: "String"
    description: "A description of what the function is."
    short-desc: "Short Description."
    success:
      code: 200
      results:
        -
          name: "err_code"
          description: "The error code. This is a success so ```-1``` is the result."
          example: -1
          comment: "-1 is a successful response"
        -
          name: "success"
          description: "Whether or not the request was successful. ``true`` or ``false``"
          example: true
        -
          name: "array_data"
          comment: "This is a comment for the array of data."
          description: "An array in an array"
          example:
              -
                name: "str_object"
                value: "string_value"
              -
                name: "int_object"
                value: 10
              -
                name: "bool_object"
                value: true
              -
                name: "array_of_values"
                value:
                  -
                    value: 10
                  -
                    value: 11
                  -
                    value: 12

    failure:
      code: 403
      results:
        -
          name: "success"
          description: "Whether or not the request was successful. ``true`` or ``false``"
          example: false
        -
          name: "err_code"
          description: "The error code."
          example: 2001
        -
          name: "error"
          description: "The error message."
          example: "That email is already in use."
      errors:
        -
          code: 2001
          error: "That email is already in use."
        -
          code: 101
          error: "Invalid Parameters"
```

## Formatted Function Display

![Above Function](http://i.imgur.com/eHMLx80.png "Above Function")