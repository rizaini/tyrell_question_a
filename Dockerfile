# Use an official PHP runtime as a parent image
FROM php:8.2-cli

# Set the working directory in the container
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install any necessary dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# Expose port 80 to the outside world
EXPOSE 80

# Run the application
CMD ["php", "-S", "0.0.0.0:80"]