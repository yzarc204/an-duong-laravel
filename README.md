# Website An Đường

### Chạy migration để tạo database

```
php artisan migrate
```

### Các tính năng cần call API được đẩy vào trong queue. Cần chạy worker để các tính năng này hoạt động

```
php artisan queue:worker
```

### Chạy GlucoseRecordSeeder để đẩy dữ liệu đường huyết test vào GlucoseRecordSeeder

#### Lưu ý: Tạo tài khoản có user_id = 1 để tránh gặp lỗi khi chạy GlucoseRecordSeeder

```
php artisan db:seed --class=GlucoseRecordSeeder
```
