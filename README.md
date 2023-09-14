
# LaraGraph

Implmenting smaple laravel-graphQl project

## HighLights

- employee CRUD with GraphQL
- passport authentication
- employee Excel export & download
- unit tested


## Project Quick Stroke Quries

Register

```graphQl
mutation{
  register(input:{
    name:"hi",
    email : "san@gmail.com",
    password:"asdffdsa",
    password_confirmation: "asdffdsa"
  }) {
   status
   tokens {
     access_token
        refresh_token
        expires_in
        token_type
  }
  }
}
```

Login
```bash
  mutation{
    login(input:{
        username:"yourEmail.com",
        password:"asdffdsa"
    }) {
        access_token
        refresh_token
        expires_in
        token_type
    }
}
```

Fetch the list of employees

```bash
query{
  employees(page: 1) {
    data {
      first_name
      last_name
      email
      phone
      department
      hire_date
    }
  }
}
```

By Id 
```bash
query{
  employee(id: 6) {
    first_name
    last_name
    email
    phone
    department
    hire_date
    
  }
}
```

Create Employee
```bash
mutation {
  createEmployee(
    input: {first_name: "Jhon", 
    last_name: "Joe",
    phone: "09123412412", 
    email: "jhon@gmail.com", 
    department: "IT"}
  ) {
    status
    employee {
      first_name
      last_name
      email
      phone
    }
  }
}
```
Update Employee

```bash
mutation {
  updateEmployee(
    input: {id: 10001, first_name: "htet", last_name: "shine", phone: "09123412412", email: "hsh@dgmail.com", department: "IT"}
  ) {
    status
    employee {
      id
      first_name
      last_name
      phone
    }
  }
}
```

Delete Employee

```bash
mutation{
  deleteEmployee(id: 10001) {
    id
  }
}
```




## API Reference

#### Export the collection of employees

```http
  GET /api/v1/employees/export/excel/{extension}
```

| Parameter | Type     | Valid                |
| :-------- | :------- | :------------------------- |
| `extension` | `string` | csv,xlsx,html |

#### Download the exported file of employe with specific

```http
  GET /api/v1/employees/export/download/{extension}
```

| Parameter | Type     | Valid                       |
| :-------- | :------- | :-------------------------------- |
| `extension` | `string` | csv,xlsx,html |



