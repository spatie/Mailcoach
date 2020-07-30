# Mailcoach

## 2.2.4 - 2020-07-30

- fix publishing of assets after composer create-project

## 2.2.3 - 2020-07-30

- do not ignore `composer.lock` after installing the package

## 2.2.2 - 2020-06-24

- added missing imports to the mail configuration settings controllers (#44)

## 2.2.1 - 2020-06-18

- fix test mail and transactional test mail

## 2.2.0 - 2020-06-10

- add translations (#43)

## 2.1.0 - 2020-04-30

- refactor to Tailwind grid (#36)

## 2.0.13 - 2020-04-07

- update config file

## 2.0.12 - 2020-03-30

- use horizon timeouts of an hour

## 2.0.11 - 2020-03-25

- add missing import in `EditMailConfigurationController`

## 2.0.10 - 2020-03-18

- fix `TransactionalMailConfiguration` (#23)

## 2.0.9 - 2020-03-16

- fix uploads having a wrong url

## 2.0.8 - 2020-03-16

- move registering settings to register method

## 2.0.7 - 2020-03-16

- allow setting app name & url from settings

## 2.0.6 - 2020-03-13

- improve clearing config cache

## 2.0.5 - 2020-03-13

- remove tail command

## 2.0.4 - 2020-03-13

- add tail command

## 2.0.3 - 2020-03-13

- use production environment by default

## 2.0.2 - 2020-03-13

- fix namespace of `SendTestTransactionalMailController`

## 2.0.1 - 2020-03-11

- fix sending with sendgrid

## 2.0.0 - 2020-03-10

- add support for multiple mailers
- add support for custom editors
- you can now set a delay on sending the welcome mail

## 1.1.1 - 2020-02-19

- fix scheduled command

## 1.1.0 - 2020-02-17

- add from email to mail configuration test email (#13)

## 1.0.10 - 2020-02-17

- fix icon alignment
- add shared secret of webhook url to config after it's set

## 1.0.9 - 2020-02-11

- fix for terminating horizon

## 1.0.8 - 2020-02-09

- clear cached config on mail config save

## 1.0.7 - 2020-02-06

- change content fields to be of type text (#9)

## 1.0.6 - 2020-01-30

- fix users screen

## 1.0.5 - 2020-01-30

- clean up seeders

## 1.0.4 - 2020-01-29

- fixed typo in `TemplateSeeder`: changed `unsubcribeUrl` to `unsubscribeUrl`

## 1.0.3 - 2020-01-29

- remove `composer.lock`

## 1.0.0 - 2020-01-29

- initial release
