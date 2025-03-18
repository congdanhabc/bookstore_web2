REM Start PHP development server in the background
start "PHP Server" php -S localhost:8000 -t public

REM Start Tailwind CSS watcher
npx @tailwindcss/cli -i ./public/css/input.css -o ./public/css/output.css --watch

pause