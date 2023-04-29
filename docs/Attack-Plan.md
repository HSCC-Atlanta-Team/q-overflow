# 2023 App Development Plan

- init a new github repository
  - add `.gitignore`
- composer libraries (commit)
  - `composer require <library>`
  - Fat Free Framework `bcosca/fatfree-core`
  - Guzzle `guzzlehttp/guzzle`
  - DD `symfony/var-dumper`
  - Rate limiter `spatie/guzzle-rate-limiter-middleware`
  - [OPTIONAL] markdown `erusev/parsedown`
- Set up some starting routes

## Stage 1
- Build models of API data structures
  - in tandem, create data MOCKs

- Build Controllers
  - anytime data models are needed, use a MOCK

- Build starting templates
  - main layout
  - nav
  - user info
  - Dashboard
  - Login

## Stage 2
- login and authentication (2 person)
  - password reset
  = registration?

- application entry point (full team)
  - use internal API & dynamic loading

- Set up our `client` class, and implement Rate limiter middleware stack
  - Create Database (or Cache) `store` class

- Repositories for all API endpoints (1 person)
  - Rate Limit
  - Error handling

## Stage 3
- Search
-  User data input handling

## Stage 4
- finishing touches and blocker resolutions

---

## Stage 5
- continue polishing
- continue adding features/requirements

## Stage 6
- continue polishing
- continue adding features/requirements

---
## COMPETITION 
---

### Issues
- Pagination
