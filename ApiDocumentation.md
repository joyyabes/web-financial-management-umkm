# Transaction API Documentation

## Base URL

```
http://127.0.0.1:8000/api/transactions
```

---

## 1. Get All Transactions

**Endpoint:**

```http
GET /api/transactions
```

**Description:** Mendapatkan semua transaksi.

**Response:**

```json
[
    {
        "transactions_from_db": [
            {
                "id": 1,
                "category_id": 1,
                "type": "income",
                "amount": 50000,
                "description": "Penjualan Nasi Kotak",
                "transaction_date": "2025-03-28",
                "created_at": "2025-03-28T02:53:02.000000Z",
                "updated_at": "2025-03-28T02:53:02.000000Z",
                "category": {
                    "id": 1,
                    "name": "Penjualan Produk",
                    "type": "income",
                    "created_at": "2025-03-28T02:51:19.000000Z",
                    "updated_at": "2025-03-28T02:51:19.000000Z"
                }
            }
        ],
        "transactions_from_session": []
    }
]
```

**Status Code:**

-   `200 OK` – Berhasil mendapatkan data.

---

## 2. Get Transaction by ID

**Endpoint:**

```http
GET /api/transactions/{id}
```

**Description:** Mendapatkan detail transaction berdasarkan ID.

**Example Request:**

```http
GET /api/transactions/{id}
```

**Response:**

```json
{
    "id": 1,
    "category_id": 1,
    "type": "income",
    "amount": 50000,
    "description": "Penjualan Nasi Kotak",
    "transaction_date": "2025-03-28",
    "created_at": "2025-03-28T02:53:02.000000Z",
    "updated_at": "2025-03-28T02:53:02.000000Z",
    "category": {
        "id": 1,
        "name": "Penjualan Produk",
        "type": "income",
        "created_at": "2025-03-28T02:51:19.000000Z",
        "updated_at": "2025-03-28T02:51:19.000000Z"
    }
}
```

**Status Code:**

-   `200 OK` – Berhasil mendapatkan data.
-   `404 Not Found` – Transaction tidak ditemukan.

---

## 3. Create a New Transactions

**Endpoint:**

```http
POST /api/transactions
```

**Description:** Membuat transaction baru.

**Request Body:**

```json
{
    "transaction_date": "2025-03-27",
    "type": "expense",
    "category_id": 2,
    "amount": 15000,
    "description": "Biaya Transportasi"
}
```

**Response:**

```json
{
    "message": "added successfully!",
    "data": {
        "transaction_date": "2025-03-27",
        "type": "expense",
        "category_id": 2,
        "amount": 15000,
        "description": "Biaya Transportasi",
        "updated_at": "2025-03-28T02:53:45.000000Z",
        "created_at": "2025-03-28T02:53:45.000000Z",
        "id": 4
    }
}
```

**Status Code:**

-   `201 Created` – Transaction berhasil dibuat.
-   `400 Bad Request` – Data tidak valid.

---

## 4. Update a Transaction

**Endpoint:**

```http
PUT /api/transactions/{id}
```

**Description:** Memperbarui transaction berdasarkan ID.

**Request Body:**

```json
{
    "transaction_date": "2025-03-28",
    "type": "income",
    "category_id": 1,
    "amount": 75000,
    "description": "Update Penjualan"
}
```

**Response:**

```json
{
    "message": "transaction successfully updated!",
    "data": {
        "id": 1,
        "transaction_date": "2025-03-28",
        "type": "income",
        "category_id": 1,
        "amount": 75000,
        "description": "Update Penjualan",
        "updated_at": "2025-03-28T04:00:00.000000Z",
        "created_at": "2025-03-28T02:53:02.000000Z"
    }
}
```

**Status Code:**

-   `200 OK` – Berhasil diperbarui.
-   `400 Bad Request` – Data tidak valid.
-   `404 Not Found` – Transaction tidak ditemukan.

---

## 5. Delete a Transaction

**Endpoint:**

```http
DELETE /api/transaction/{id}
```

**Description:** Menghapus transaction berdasarkan ID.

**Example Request:**

```http
DELETE /api/transaction/{id}
```

**Response:**

```json
{
     "message":"transaction successfully deleted!"
}
```

**Status Code:**

-   `200 OK` – Berhasil dihapus.
-   `404 Not Found` – Transaction tidak ditemukan.

