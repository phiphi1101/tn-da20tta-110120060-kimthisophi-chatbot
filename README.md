
Flowise - Build LLM Apps Easily
Release Notes Discord Twitter Follow GitHub star chart GitHub fork

English | 中文 | 日本語 | 한국어

Drag & drop UI to build your customized LLM flow

⚡Quick Start
Download and Install NodeJS >= 18.15.0

Install Flowise

npm install -g flowise
Start Flowise

npx flowise start
With username & password

npx flowise start --FLOWISE_USERNAME=user --FLOWISE_PASSWORD=1234
Open http://localhost:3000

🐳 Docker
Docker Compose
Go to docker folder at the root of the project
Copy .env.example file, paste it into the same location, and rename to .env
docker-compose up -d
Open http://localhost:3000
You can bring the containers down by docker-compose stop
Docker Image
Build the image locally:

docker build --no-cache -t flowise .
Run image:

docker run -d --name flowise -p 3000:3000 flowise
Stop image:

docker stop flowise
👨‍💻 Developers
Flowise has 3 different modules in a single mono repository.

server: Node backend to serve API logics
ui: React frontend
components: Third-party nodes integrations
Prerequisite
Install PNPM
npm i -g pnpm
Setup
Clone the repository

git clone https://github.com/FlowiseAI/Flowise.git
Go into repository folder

cd Flowise
Install all dependencies of all modules:

pnpm install
Build all the code:

pnpm build
Start the app:

pnpm start
You can now access the app on http://localhost:3000

For development build:

Create .env file and specify the VITE_PORT (refer to .env.example) in packages/ui

Create .env file and specify the PORT (refer to .env.example) in packages/server

Run

pnpm dev
Any code changes will reload the app automatically on http://localhost:8080

🔒 Authentication
To enable app level authentication, add FLOWISE_USERNAME and FLOWISE_PASSWORD to the .env file in packages/server:

FLOWISE_USERNAME=user
FLOWISE_PASSWORD=1234
