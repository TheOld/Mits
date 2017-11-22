# Mitsubishi Motors New Zealand

A new CMS website for Mitsubihsi New Zealand

## Developing

To get up and running in a vagrant box, run `  vagrant up `






The rest of the readme should should cover how to get this project running, and how to deploy it if there are any special requirements.

Specifics about the project beyond installing and deploying belong in the `docs/` folder. You can link to these files with [relative links](docs/how-to-markdown.md).






## GraphQL

### Authentication

The GraphQL endpoint require an admin user with administrator access.

We are using a module (firesphere/silverstripe-graphql-jwt) to generate a JWT for the admin user. After we receive the JWT we (like the Hub GraphQL
implementation) pass it as an Authorisation header as 'Bearer long.token.string'.

To generate the token we hit the graphql endpoint with this mutation payload:

```

mutation {
  createToken(Email: "example@example.com", Password: "XxxxX") {
    Token,
    ID,
    FirstName,
    Surname
  }
}

```


The response will contain the token and look something like this:

```
{
    "data": {
        "createToken": {
            "Token": "XXXXxxXXxXXxx.XXXVXV.XxxxXXX",
            "ID": "4",
            "FirstName": "Claire",
            "Surname": "Finnie"
        }
    }
}
```

## Interface

The interface details of the project are available on a dedicated readme [here](./themes/base/README.md)




### PDF generation with WkHTMLToPdf

This is used to generate DF summaries in the Vehicle Buidler and Accessories hub. 

To get this running in your dev environment you will need to install wkhtmltopdf in your vagrant box, if it is setup already.

	sudo apt-get update
	sudo apt-get install xvfb libfontconfig wkhtmltopdf

Test it is working by running this command in Terminal from within the Vagrant box

	/usr/bin/xvfb-run /usr/bin/wkhtmltopdf google.com google.pdf


If everything is working correctly you should have a PDF of the google.com (google.pdf) sitting in the directory where you ran that command


