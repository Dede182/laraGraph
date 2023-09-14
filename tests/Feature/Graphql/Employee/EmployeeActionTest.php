<?php

namespace Tests\Feature\Graphql\Employee;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class EmployeeActionTest extends TestCase
{
    use MakesGraphQLRequests;

    public function test_create_the_employee()
    {
        $this->AuthUser();
        $response = $this->graphQL('
            mutation {
                createEmployee(
                    input:{
                        first_name:"Jhon",
                        last_name:"Joe",
                        phone:"09123412412",
                        email:"jhon@gmail.com",
                        department:"IT"
                         })
                    {
                        status
                        employee {
                            email
                        }
                    }
                }
                    ');

        $jsonResponse = json_decode($response->getContent(), true);
        $status = $jsonResponse['data']['createEmployee']['status'];
        $this->assertEquals('SUCCESS', $status);
        $this->assertDatabaseHas('employees', [
            'email' => 'jhon@gmail.com']);
    }

    public function test_not_owner_cannot_update_the_employee()
    {
        $this->AuthUser();
        $this->createEmployee();

        $response = $this->updateEmployeeGraphqlQuery();
        $jsonResponse = json_decode($response->getContent(), true);
        $unauthorized = $jsonResponse['errors'][0]['message'];
        $this->assertEquals('This action is unauthorized.', $unauthorized);
    }

    public function test_owner_can_update_the_employee()
    {
        $auth = $this->AuthUser();
        $employee = $this->createEmployee([
            'user_id' => $auth->id,
        ]);

        $response = $this->updateEmployeeGraphqlQuery($employee->id);
        $jsonResponse = json_decode($response->getContent(), true);
        $status = $jsonResponse['data']['updateEmployee']['status'];
        $this->assertEquals('SUCCESS', $status);
        $this->assertDatabaseHas('employees', ['email' => 'hsh@dgmail.com']);

    }

    public function test_not_owner_cannot_delete_the_employee()
    {
        $this->AuthUser();
        $this->createEmployee();

        $response = $this->deleteEmployeeGraphqlQuery('1');
        $jsonResponse = json_decode($response->getContent(), true);
        $unauthorized = $jsonResponse['errors'][0]['message'];
        $this->assertEquals('This action is unauthorized.', $unauthorized);
    }

    public function test_owner_can_delete_the_employee()
    {
        $auth = $this->AuthUser();
        $employee = $this->createEmployee([
            'user_id' => $auth->id,
        ]);

        $response = $this->deleteEmployeeGraphqlQuery($employee->id);
        $jsonResponse = json_decode($response->getContent(), true);

        $status = $jsonResponse['data']['deleteEmployee']['id'];
        $this->assertEquals($employee->id, $status);
        $this->assertDatabaseMissing('employees', ['email' => $employee->email]);
    }




    protected function deleteEmployeeGraphqlQuery(string $id)
    {
        return $this->graphQl('
        mutation DeleteEmployee($id: ID!) {
            deleteEmployee(id: $id)
            {
              id
            }
          }',[
            'id' => $id,
          ]);
    }

    protected function updateEmployeeGraphqlQuery(string $id = "1")
    {
        return $this->graphQL('
        mutation UpdateEmployee($id: ID!) {
            updateEmployee(input:{
                id: $id,
                first_name:"htet",
                last_name:"shine",
                phone:"09123412412",
                email:"hsh@dgmail.com",
                department:"IT"
            }) {
                status
                employee {
                    id
                    first_name
                    last_name
                    phone
                }
            }
        }',
            [
                'id' => $id,
            ]
        );
    }

}
