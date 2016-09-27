# JumpButton Studio API Documentation System
An open source API Documentation System.
With simple YAML file you can document your server-side API and have beautiful easy to read HTML page ready for the rest of your team.

##Requirements
PHP Server with **PHP_YAML** extension installed.

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
          type: "int"
          description: "The error code. This is a success so ```-1``` is the result."
          example: -1
        -
           name: "success"
           type: "bool"
           description: "Whether or not the request was successful. ``true`` or ``false``"
           example: true
    failure:
      code: 403
      results:
        -
          name: "success"
          type: "bool"
          description: "Whether or not the request was successful. ``true`` or ``false``"
          example: false
        -
          name: "err_code"
          type: "int"
          description: "The error code."
          example: 2001
        -
          name: "error"
          type: "string"
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