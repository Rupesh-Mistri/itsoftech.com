from jinja2 import Environment, FileSystemLoader
import os

# Set correct path
BASE_DIR = r'D:\itsoftech.com\itsoftech.com'
TEMPLATE_DIR = BASE_DIR
OUTPUT_DIR = BASE_DIR

# Ensure output directory exists
os.makedirs(OUTPUT_DIR, exist_ok=True)

# Setup Jinja2
env = Environment(loader=FileSystemLoader(TEMPLATE_DIR))

# Find all matching templates
template_files = [f for f in os.listdir(TEMPLATE_DIR) if f.startswith("1") and f.endswith(".html")]
print("Found templates:", template_files)

# Render and write output
for template_file in template_files:
    print(f"Rendering template: {template_file}")
    template = env.get_template(template_file)
    rendered_html = template.render()
    output_filename = template_file[1:]  # remove leading '1'
    output_path = os.path.join(OUTPUT_DIR, output_filename)

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write(rendered_html)

    print(f"Rendered {output_filename} saved to {output_path}")
