<?php

namespace Tests\Feature\Graphql\Employee;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\CreatesApplication;
use Tests\TestCase;

class EmployeeListTest extends TestCase
{

    use MakesGraphQLRequests;

    public function test_unauthorized_request()
    {
        $response = $this->graphQL('
        query{
            employees(page:1) {
              data
              {
                first_name
              }
            }
          }'
        );
        $jsonResponse = json_decode($response->getContent(), true);
        $message = $jsonResponse['errors'][0]['message'];
        $this->assertEquals('Unauthenticated.', $message);
    }

    public function test_get_the_list_of_employees()
    {
        $this->authAndCreateEmployee();
        $this->createEmployee();

        $response = $this->graphQL('
        query{
            employees(page:1) {
              data
              {
                first_name
              }
            }
          }'
        );

        $jsonResponse = json_decode($response->getContent(), true);
        $data = $jsonResponse['data']['employees']['data'];
        $this->assertEquals(2, count($data));
    }

    public function test_get_the_employee_by_id()
    {
        $this->authAndCreateEmployee();
        $employee = $this->createEmployee();

        $response = $this->graphQL('
            query ($employeeId: ID!) {
                employee(id: $employeeId) {
                    first_name
                }
            }',
        ['employeeId' => $employee->id] // Pass the employee's ID as a variable
        );

        $jsonResponse = json_decode($response->getContent(), true);
        $firstName = $jsonResponse['data']['employee']['first_name'];
        $this->assertEquals($employee->first_name, $firstName);
    }

    protected function authAndCreateEmployee()
    {
        $this->AuthUser();
        $this->createEmployee();
    }
}
