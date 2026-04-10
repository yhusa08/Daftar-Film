import subprocess
import os

os.chdir(r'c:\xampp\htdocs\film-app')

# Run artisan migrate refresh with seed
result = subprocess.run([r'c:\xampp\php\php.exe', 'artisan', 'migrate:refresh', '--seed'], 
                       capture_output=True, text=True)

print("STDOUT:")
print(result.stdout)
print("\nSTDERR:")
print(result.stderr)
print("\nReturn code:", result.returncode)
