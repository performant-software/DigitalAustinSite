# Digital Austin Papers

This repository contains the code running the Digital Austin Papers website.

## Deployment

The site is currently hosted on [Cloudways](https://www.cloudways.com/en/). There are some manual pieces of the deployment process to keep track of:

- Cloudways will not automatically deploy from Git, but they do provide a "Deployment via GIT" menu that can be manually triggered and is currently set up to point to [this repo](https://github.com/performant-software/DigitalAustinSite).
- Cloudways will not run `composer install`, `npm install`, or `npm build` for you. If you've changed any dependencies, you must SSH into the server and run the relevant commands manually. The NPM scripts must be run while in root mode, i.e. by logging in through your Cloudways server's Master Credentials, due to permissions issues.
- Environment variables are loaded from a `.env` file in the root level of this project (i.e., in Cloudways, `/public_html/.env`). A list of required variables, with some non-private ones prepopulated, is available at `.env.sample`.
