# Website An Đường

### Chạy migration để tạo database

```
php artisan migrate
```

### Các tính năng cần call API được đẩy vào trong queue. Cần chạy worker để các tính năng này hoạt động

```
php artisan queue:work
```

### Chạy GlucoseRecordSeeder để đẩy dữ liệu đường huyết test vào database

#### Lưu ý: Tạo tài khoản đầu tiên (id = 1) trước để tránh gặp lỗi khi chạy GlucoseRecordSeeder

```
php artisan db:seed --class=GlucoseRecordSeeder
```
