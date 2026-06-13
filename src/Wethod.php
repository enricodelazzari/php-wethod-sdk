<?php

namespace EnricoDeLazzari\Wethod;

use EnricoDeLazzari\Wethod\Exceptions\WethodRequestException;
use EnricoDeLazzari\Wethod\Resource\Budget;
use EnricoDeLazzari\Wethod\Resource\BudgetArea;
use EnricoDeLazzari\Wethod\Resource\BudgetDay;
use EnricoDeLazzari\Wethod\Resource\BudgetJobTitle;
use EnricoDeLazzari\Wethod\Resource\BudgetPriceListLevel;
use EnricoDeLazzari\Wethod\Resource\BudgetTask;
use EnricoDeLazzari\Wethod\Resource\BusinessUnit;
use EnricoDeLazzari\Wethod\Resource\Capacity;
use EnricoDeLazzari\Wethod\Resource\Client;
use EnricoDeLazzari\Wethod\Resource\Contact;
use EnricoDeLazzari\Wethod\Resource\CustomField;
use EnricoDeLazzari\Wethod\Resource\CustomFieldOption;
use EnricoDeLazzari\Wethod\Resource\Holiday;
use EnricoDeLazzari\Wethod\Resource\Invoice;
use EnricoDeLazzari\Wethod\Resource\JobOrderCategory;
use EnricoDeLazzari\Wethod\Resource\JobOrderCategoryGroup;
use EnricoDeLazzari\Wethod\Resource\JobTitle;
use EnricoDeLazzari\Wethod\Resource\Level;
use EnricoDeLazzari\Wethod\Resource\Location;
use EnricoDeLazzari\Wethod\Resource\Payroll;
use EnricoDeLazzari\Wethod\Resource\PeopleAllocation;
use EnricoDeLazzari\Wethod\Resource\Person;
use EnricoDeLazzari\Wethod\Resource\PersonCapacity;
use EnricoDeLazzari\Wethod\Resource\PriceList;
use EnricoDeLazzari\Wethod\Resource\PriceListLevel;
use EnricoDeLazzari\Wethod\Resource\Product;
use EnricoDeLazzari\Wethod\Resource\Production;
use EnricoDeLazzari\Wethod\Resource\ProductionPlan;
use EnricoDeLazzari\Wethod\Resource\ProductionPlanStream;
use EnricoDeLazzari\Wethod\Resource\ProductionStream;
use EnricoDeLazzari\Wethod\Resource\ProductLevel;
use EnricoDeLazzari\Wethod\Resource\Project;
use EnricoDeLazzari\Wethod\Resource\ProjectMetadata;
use EnricoDeLazzari\Wethod\Resource\ProjectPlanArea;
use EnricoDeLazzari\Wethod\Resource\ProjectPlanSubtask;
use EnricoDeLazzari\Wethod\Resource\ProjectPlanSubtaskAssignee;
use EnricoDeLazzari\Wethod\Resource\ProjectPlanTask;
use EnricoDeLazzari\Wethod\Resource\ProjectPlanTaskAssignee;
use EnricoDeLazzari\Wethod\Resource\ProjectStage;
use EnricoDeLazzari\Wethod\Resource\ProjectStatus;
use EnricoDeLazzari\Wethod\Resource\ProjectType;
use EnricoDeLazzari\Wethod\Resource\Role;
use EnricoDeLazzari\Wethod\Resource\Stream;
use EnricoDeLazzari\Wethod\Resource\Timesheet;
use EnricoDeLazzari\Wethod\Resource\TimesheetLog;
use EnricoDeLazzari\Wethod\Resource\TimesheetWhitelist;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Wethod extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

    /**
     * @param  string  $token  Personal API token (sent as a Bearer token).
     * @param  string  $company  Company endpoint slug, e.g. "acme" for acme.wethod.com.
     * @param  string  $apiVersion  Wethod API version.
     */
    public function __construct(
        protected string $token,
        protected string $company,
        protected string $apiVersion = '2024-06-15',
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://api.wethod.com';
    }

    protected function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator($this->token);
    }

    public function defaultHeaders(): array
    {
        return [
            'Wethod-Company' => $this->company,
            'Wethod-Version' => $this->apiVersion,
            'Accept' => 'application/json',
        ];
    }

    public function getRequestException(Response $response, ?\Throwable $senderException): ?\Throwable
    {
        return WethodRequestException::fromResponse($response, $senderException);
    }

    /**
     * Build an offset paginator for any list (Paginatable) request.
     */
    public function paginate(Request $request): Paginator
    {
        return new WethodPaginator($this, $request);
    }

    public function budget(): Budget
    {
        return new Budget($this);
    }

    public function budgetArea(): BudgetArea
    {
        return new BudgetArea($this);
    }

    public function budgetDay(): BudgetDay
    {
        return new BudgetDay($this);
    }

    public function budgetJobTitle(): BudgetJobTitle
    {
        return new BudgetJobTitle($this);
    }

    public function budgetPriceListLevel(): BudgetPriceListLevel
    {
        return new BudgetPriceListLevel($this);
    }

    public function budgetTask(): BudgetTask
    {
        return new BudgetTask($this);
    }

    public function businessUnit(): BusinessUnit
    {
        return new BusinessUnit($this);
    }

    public function capacity(): Capacity
    {
        return new Capacity($this);
    }

    public function client(): Client
    {
        return new Client($this);
    }

    public function contact(): Contact
    {
        return new Contact($this);
    }

    public function customField(): CustomField
    {
        return new CustomField($this);
    }

    public function customFieldOption(): CustomFieldOption
    {
        return new CustomFieldOption($this);
    }

    public function holiday(): Holiday
    {
        return new Holiday($this);
    }

    public function invoice(): Invoice
    {
        return new Invoice($this);
    }

    public function jobOrderCategory(): JobOrderCategory
    {
        return new JobOrderCategory($this);
    }

    public function jobOrderCategoryGroup(): JobOrderCategoryGroup
    {
        return new JobOrderCategoryGroup($this);
    }

    public function jobTitle(): JobTitle
    {
        return new JobTitle($this);
    }

    public function level(): Level
    {
        return new Level($this);
    }

    public function location(): Location
    {
        return new Location($this);
    }

    public function payroll(): Payroll
    {
        return new Payroll($this);
    }

    public function peopleAllocation(): PeopleAllocation
    {
        return new PeopleAllocation($this);
    }

    public function person(): Person
    {
        return new Person($this);
    }

    public function personCapacity(): PersonCapacity
    {
        return new PersonCapacity($this);
    }

    public function priceList(): PriceList
    {
        return new PriceList($this);
    }

    public function priceListLevel(): PriceListLevel
    {
        return new PriceListLevel($this);
    }

    public function product(): Product
    {
        return new Product($this);
    }

    public function productLevel(): ProductLevel
    {
        return new ProductLevel($this);
    }

    public function production(): Production
    {
        return new Production($this);
    }

    public function productionPlan(): ProductionPlan
    {
        return new ProductionPlan($this);
    }

    public function productionPlanStream(): ProductionPlanStream
    {
        return new ProductionPlanStream($this);
    }

    public function productionStream(): ProductionStream
    {
        return new ProductionStream($this);
    }

    public function project(): Project
    {
        return new Project($this);
    }

    public function projectMetadata(): ProjectMetadata
    {
        return new ProjectMetadata($this);
    }

    public function projectPlanArea(): ProjectPlanArea
    {
        return new ProjectPlanArea($this);
    }

    public function projectPlanSubtask(): ProjectPlanSubtask
    {
        return new ProjectPlanSubtask($this);
    }

    public function projectPlanSubtaskAssignee(): ProjectPlanSubtaskAssignee
    {
        return new ProjectPlanSubtaskAssignee($this);
    }

    public function projectPlanTask(): ProjectPlanTask
    {
        return new ProjectPlanTask($this);
    }

    public function projectPlanTaskAssignee(): ProjectPlanTaskAssignee
    {
        return new ProjectPlanTaskAssignee($this);
    }

    public function projectStage(): ProjectStage
    {
        return new ProjectStage($this);
    }

    public function projectStatus(): ProjectStatus
    {
        return new ProjectStatus($this);
    }

    public function projectType(): ProjectType
    {
        return new ProjectType($this);
    }

    public function role(): Role
    {
        return new Role($this);
    }

    public function stream(): Stream
    {
        return new Stream($this);
    }

    public function timesheet(): Timesheet
    {
        return new Timesheet($this);
    }

    public function timesheetLog(): TimesheetLog
    {
        return new TimesheetLog($this);
    }

    public function timesheetWhitelist(): TimesheetWhitelist
    {
        return new TimesheetWhitelist($this);
    }
}
