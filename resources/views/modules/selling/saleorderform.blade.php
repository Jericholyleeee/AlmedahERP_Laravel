<div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#salesOrderCard1" aria-expanded="true">
          CUSTOMER INFORMATION
        </button>
      </h2>
    </div>
    <div class="collapse show" id="salesOrderCard1">
      <div class="card-body">
        <form action="" id="saleCustomerForm">
          <div class="row">
            <div class="col">
              <br>
              <label class=" text-nowrap align-middle">
                Customer ID
              </label>
              <div class="d-flex">
                <input type="number" class="form-input form-control" max="6" value="0000001" disabled id="custId" required>
                <button class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <br>
              <label class=" text-nowrap align-middle">
                First Name
              </label>
              <input type="text" required class="form-input form-control" id="fName" required>
              <br>
              <label class=" text-nowrap align-middle">
                Last Name
              </label>
              <input type="text" required class="form-input form-control" id="lName">
              <br>
              <label class=" text-nowrap align-middle">
                Contact Number
              </label>
              <input type="number" required class="form-input form-control" max="11" id="contactNum">
            </div>
            <div class="col">
              <br>
              <label class=" text-nowrap align-middle">
                Email Address
              </label>
              <input type="text" required class="form-input form-control" id="custEmail">
              <br>
              <label class=" text-nowrap align-middle">
                Branch Name
              </label>
              <input type="text" required class="form-input form-control" id="branchName">
              <br>
              <label class=" text-nowrap align-middle">
                Company Name
              </label>
              <input type="text" required class="form-input form-control" id="companyName">
              <br>
              <label>Address</label>
              <input class="form-control" id="custAddress"></input>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard2" aria-expanded="false">
          SALES
        </button>
      </h2>
    </div>
    <div id="salesOrderCard2" class="collapse">
      <div class="card-body">
        <form action="" id="saleFormInfo">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <br>
                <label class="text-nowrap align-middle">
                  Sales ID
                </label>
                <input type="number" class="form-input form-control" max="20" id="salesId">
                <br>
                <label class="text-nowrap align-middle">
                  Sales Unit
                </label>
                <input type="text" class="form-input form-control" max="20" id="salesUnit">
                <div class="row ml-1">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isSellable" onclick="sellable();">
                  </div>
                  <label for="isSellable" class="form-check-label" style="font-size: 14px;">Is Sellable</label>
                </div>
                <label class="text-nowrap align-middle">
                  Cost Price
                </label>
                <input type="number" class="form-input form-control sellable" max="6" id="costPrice" disabled>
                <br>
                <label class="text-nowrap align-middle">
                  Sale Currency
                </label>
                <input type="text" class="form-input form-control sellable" max="20" id="saleCurrency" disabled>
                <br>
                <label class=" text-nowrap align-middle">
                  Sales Supply Method
                </label>
                <select class="form-control sellable" id="saleSupplyMethod" onchange="selectSalesMethod();" disabled>
                  <option selected disabled>Please Select</option>
                  <option value="Produce">Produce</option>
                  <option value="Purchase">Purchase</option>
                  <option value="Stock">From Stock</option>
                </select>
                <br>
                <label class="text-nowrap align-middle">
                  Payment Method
                </label>
                <select class="form-control sellable" id="salePaymentMethod" onchange="selectPaymentMethod();" disabled>
                  <option selected disabled>Please Select</option>
                  <option value="Cash">Full Payment(Cash)</option>
                  <option value="Installment">Installment</option>
                </select>
                <br>
                <label class="text-nowrap align-middle">
                  Unrenewed
                </label>
                <input type="text" class="form-input form-control sellable" max="20" id="saleUnrenewed" disabled>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <br>
                <label class=" text-nowrap align-middle">
                  Product Pulled Off Market
                </label>
                <input class="form-control" type="date" value="2021-01-01" id="productPulledMarket">
                <br>
                <label class="text-nowrap align-middle">
                  Date
                </label>
                <input class="form-control" type="date" value="2021-01-01" id="saleDate">
                <br>
                <label class=" text-nowrap align-middle">
                  Product Launch Date
                </label>
                <input class="form-control" type="date" value="2021-01-01" id="productLaunchDate">
                <br>
                <label class=" text-nowrap align-middle">
                  Product Code
                </label>
                <select class="form-control" id="saleProductCode">
                  <option>PRODUCT-CODE-SAMPLE-1</option>
                  <option>PRODUCT-CODE-SAMPLE-2</option>
                  <option>PRODUCT-CODE-SAMPLE-3</option>
                  <option>PRODUCT-CODE-SAMPLE-4</option>
                </select>
                <br>
                <label class=" text-nowrap align-middle">
                  Version
                </label>
                <input type="text" class="form-input form-control" max="20" id="saleVersion">
                <br>
                <label class="text-nowrap align-middle">
                  Quantity
                </label>
                <input type="text" class="form-input form-control" max="20" id="saleQuantity">
                <br>
                <label class=" text-nowrap align-middle">
                  Stock Unit
                </label>
                <input type="text" class="form-input form-control" max="20" id="saleStockUnit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label>
                Description
              </label>
              <input type="text" class="form-input form-control" max="300" id="saleDescription">
            </div>
          </div>
          <br>
          <div class="row" id="paymentInstallment" style="display:none;">
            <div class="col">
              <label class="text-nowrap align-middle">
                Initial Payment(Downpayment)
              </label>
              <input type="number" class="form-input form-control sellable" id="saleDownpaymentCost" placeholder="0.00">
            </div>
            <div class="col">
              <div class="form-group">
                <label class="text-nowrap align-middle">
                  Installment Type
                </label>
                <select class="form-control" max="20" id="saleInstallmentNo">
                  <option>Installment 1</option>
                  <option selected>Installment 2</option>
                  <option>Installment 3</option>
                  <option>Installment 4</option>
                  <option>Installment 5</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card" id="cardComponent" style="display:none;">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard3" aria-expanded="false">
            COMPONENTS
          </button>
        </h2>
      </div>
      <div id="salesOrderCard3" class="collapse">
        <div class="card-body">
          <div class="row">
            <div class="col-12 form-group">
              <table class="table border-bottom table-hover table-bordered">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td></td>
                    <td>Component Name</td>
                    <td>Category</td>
                    <td>Qty. Available</td>
                    <td>Qty. Needed</td>
                    <td>Status</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td class="text-center">
                      Emulsifier Component 1
                    </td>
                    <td class="text-center">
                      Component
                    </td>
                    <td class="text-center">
                      2
                    </td>
                    <td class="text-center">
                      2
                    </td>
                    <td class="text-primary text-center">
                      Available
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td class="text-center">
                      Emulsifier Component 2
                    </td>
                    <td class="text-center">
                      Component
                    </td>
                    <td class="" style="text-align: center;">
                      0
                    </td>
                    <td class="text-center">
                      3
                    </td>
                    <td class="text-danger text-center">
                      Out of stock
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td class="text-center">
                      Bar Shaft
                    </td>
                    <td class="text-center">
                      Raw Materials
                    </td>
                    <td class="" style="text-align: center;">
                      3
                    </td>
                    <td class="text-center">
                      10
                    </td>
                    <td class="text-danger text-center">
                      Insufficient
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label text-muted">Add Selected to Work Order</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label text-muted">Re-Order Selected Raw Materials</label>
              </div>
            </div>
            <div class="col">
              <button type="button" class="btn btn-primary m-1 float-right menu" data-dismiss="modal" data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
              <a class="" href="#" style="text-decoration: none;color:white">
                  Save and Proceed to Work Order
              </a>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./js/salesorder.js"></script>