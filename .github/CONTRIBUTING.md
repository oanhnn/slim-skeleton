# Contribution Guide

Contributions are **welcome** and will be fully **credited**.

Please read and understand the contribution guide before creating an issue or pull request.

This project adheres to the following standards and practices.

## Etiquette

This project is open source, and as such, the maintainers give their free time to build and maintain the source code held within. They make the code freely available in the hope that it will be of use to other developers. It would be extremely unfair for them to suffer abuse or anger for their hard work.

Please be considerate towards maintainers when raising issues or presenting pull requests. Let's show the world that developers are civilized and selfless people.

It's the duty of the maintainer to ensure that all submissions to the project are of sufficient quality to benefit the project. Many developers have different skillsets, strengths, and weaknesses. Respect the maintainer's decision, and do not be upset or abusive if your submission is not used.

## Viability

When requesting or submitting new features, first consider whether it might be useful to others. Open source projects are used by many developers, who may have entirely different needs to your own. Think about whether or not your feature is likely to be used by other users of the project.

## Procedure

Before filing an issue:

- Attempt to replicate the problem, to ensure that it wasn't a coincidental incident.
- Check to make sure your feature suggestion isn't already present within the project.
- Check the pull requests tab to ensure that the bug doesn't have a fix in progress.
- Check the pull requests tab to ensure that the feature isn't already in progress.

Before submitting a pull request:

- Check the codebase to ensure that your feature doesn't already exist.
- Check the pull requests to ensure that another person hasn't already submitted the feature or fix.

## Requirements

If the project maintainer has any additional requirements, you will find them listed here.

- [Coding Standards](#coding-standards)
- Add tests! - Your patch won't be accepted if it doesn't have tests.
- Document any change in behaviour - Make sure the README.md and any other relevant documentation are kept up-to-date.
- Consider our [release cycle](#versioning).
- One pull request per feature - If you want to do more than one thing, send multiple pull requests.
- Send coherent history - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](https://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.
- Accordingly all pull requests MUST be sent to the `develop` branch. See [Git flow](#git-flow)

## Versioning

This project is versioned under the [Semantic Versioning](http://semver.org/) guidelines as much as possible.

Releases will be numbered with the following format:

- `<major>.<minor>.<patch>`
- `<breaking>.<feature>.<fix>`

And constructed with the following guidelines:

- Breaking backward compatibility bumps the major and resets the minor and patch.
- New additions without breaking backward compatibility bump the minor and reset the patch.
- Bug fixes and misc changes bump the patch.


## Coding Standards

This project follows the FIG PHP Standards Recommendations:

- [PSR-1: Basic Coding Standard](http://www.php-fig.org/psr/psr-1/) 
- [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12) 
- [PSR-4: Autoloader](http://www.php-fig.org/psr/psr-4/)

The easiest way to apply the conventions is to install [PHP Code Sniffer](https://pear.php.net/package/PHP_CodeSniffer)


## Git Flow

This project follows [Git-Flow](http://nvie.com/posts/a-successful-git-branching-model/), and as such has `master` (latest stable releases), `develop` (latest WIP development) and X.Y support branches (when there's multiple major versions).

Accordingly all pull requests MUST be sent to the `develop` branch.

> **Note:** Pull requests which do not follow these guidelines will be closed without any further notice.


**Happy coding**!
