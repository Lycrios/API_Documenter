# JumpButton Studio API Documentation System
An open source API Documentation System.
With simple YAML file you can document your server-side API and have beautiful easy to read HTML page ready for the rest of your team.

##Requirements
PHP Server with **PHP_YAML** extension installed.

## Recent Updates

### Version 1.02
* Added some fail safe checks (AKA Bug fixes on the function pages.)

### Version 1.01
* Modified the script so that you no longer need to define the return type of success and failures.
* Added script version number to the HTML title.
* Made a config.php file for easy configuration.
* Modified document.class.php to work in subfolders eg http://www.test.com/api_documentation/{SCRIPT_HERE}

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
        -
          name: "success"
          description: "Whether or not the request was successful. ``true`` or ``false``"
          example: true
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

![Above Function](http://s2.jumpbuttonstudio.com/example_function.png "Above Function")