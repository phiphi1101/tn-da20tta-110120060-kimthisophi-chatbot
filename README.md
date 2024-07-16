<!-- markdownlint-disable MD030 -->

# Flowise - Low-Code LLM apps builder

English | [中文](./README-ZH.md)

![Flowise](https://github.com/FlowiseAI/Flowise/blob/main/images/flowise.gif?raw=true)

Drag & drop UI to build your customized LLM flow
## Cách cài đặt 
  - Cài đặt PHP phiên bản 7.3 trở lên và Composer
  - Tải dự án từ github

          git clone https://github.com/phiphi1101/tn-da20tta-110120060-kimthisophi-chatbot.git
  - Cài đặt phần còn thiếu của dự án

          composer install
          composer update

  - Chạy dự án
    - Chạy lệnh sau để xóa symbolic link cũ trong thư mục public của Laravel 
   
           Remove-Item -Recurse -Force public\storage
    - Chạy lệnh sau để tạo ra một symbolic link mới trong thư mục public của Laravel
   
           php artisan storage:link
    - Chạy lệnh sau để tạo các bảng cơ sở dữ liệu
   
          php artisan migrate:fresh --seed
    - Chạy dự án laravel

          php artisan serve
    - Truy cập vào địa chỉ localhost vừa xuất hiện
   
          http://127.0.0.1:8000/

## ⚡Quick Start Flowise

1. Install Flowise
    ```bash
    npm install -g flowise
    ```
2. Start Flowise

    ```bash
    npx flowise start
    ```

3. Open [http://localhost:3000](http://localhost:3000)

## 🔒 Authentication

To enable app level authentication, add `FLOWISE_USERNAME` and `FLOWISE_PASSWORD` to the `.env` file:

```
FLOWISE_USERNAME=user
FLOWISE_PASSWORD=1234
```

## 🌱 Env Variables

Flowise support different environment variables to configure your instance. You can specify the following variables in the `.env` file inside `packages/server` folder. Read [more](https://github.com/FlowiseAI/Flowise/blob/main/CONTRIBUTING.md#-env-variables)

You can also specify the env variables when using `npx`. For example:

```
npx flowise start --PORT=3000 --DEBUG=true
```

## 📖 Tests

We use [Cypress](https://github.com/cypress-io) for our e2e testing. If you want to run the test suite in dev mode please follow this guide:

```sh
cd Flowise/packages/server
pnpm install
./node_modules/.bin/cypress install
pnpm build
#Only for writting new tests on local dev -> pnpm run cypress:open
pnpm run e2e
```

## 📖 Documentation

[Flowise Docs](https://docs.flowiseai.com/)

## 🌐 Self Host

### [Railway](https://docs.flowiseai.com/deployment/railway)

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/YK7J0v)

### [Render](https://docs.flowiseai.com/deployment/render)

[![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://docs.flowiseai.com/deployment/render)

### [AWS](https://docs.flowiseai.com/deployment/aws)

### [Azure](https://docs.flowiseai.com/deployment/azure)

### [DigitalOcean](https://docs.flowiseai.com/deployment/digital-ocean)

### [GCP](https://docs.flowiseai.com/deployment/gcp)

## 💻 Cloud Hosted

Coming Soon

## 🙋 Support

Feel free to ask any questions, raise problems, and request new features in [discussion](https://github.com/FlowiseAI/Flowise/discussions)

## 🙌 Contributing

See [contributing guide](https://github.com/FlowiseAI/Flowise/blob/master/CONTRIBUTING.md). Reach out to us at [Discord](https://discord.gg/jbaHfsRVBW) if you have any questions or issues.

## Thông tin liên hệ tác giả
  - Họ tên: Kim Thị Sô Phi
  - SĐT: 0382533858
  - Email:kimthisophi1101@gmail.com
