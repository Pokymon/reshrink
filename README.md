# Reshrink

Reshrink is a web application designed to simplify the process of URL shortening. With an intuitive interface, Reshrink allows you to convert long URLs into short, manageable links. This is particularly useful for sharing links in a more user-friendly manner across different platforms.

## Installation

This project is built with Laravel. Follow these steps to get it running on your local machine:

1. Clone the repository to your local machine using:

   ```bash
   git clone https://github.com/Pokymon/reshink.git
   ```

2. Navigate to the project directory with:

   ```bash
   cd reshrink
   ```

3. Copy `.env.example` to `.env` and update the environment variables to match your setup:

   ```bash
   cp .env.example .env
   ```

4. Install Composer if you haven't already. You can download it from [getcomposer.org](https://getcomposer.org/).

5. Update project dependencies with Composer by running:

   ```bash
   composer update
   ```

6. Generate the application key:

   ```bash
   php artisan key:generate
   ```

7. Run database migrations:

   ```bash
   php artisan migrate
   ```

8. Start the local development server with:
   ```bash
   php artisan serve
   ```

Now you can access the Reshrink web application locally.

## Contributing

We welcome contributions to Reshrink. Feel free to fork the repository or submit a pull request. We appreciate any help, whether it's fixing bugs, improving documentation, or suggesting new features.

## License

Reshrink is distributed under the MIT License. See the `LICENSE` file for more information.

## Contact

If you have any questions or suggestions, feel free to reach out at business@pokymons.com.
