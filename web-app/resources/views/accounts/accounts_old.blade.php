<form action="{{ route('accountstore') }}" method="post">
  @csrf
  <div class="form-group">
    <label for="account_name">Account Name</label>
    <input type="text" class="form-control" id="account_name" name="account_name" required>
  </div>
  <div class="form-group">
    <label for="owner">Owner</label>
    <input type="number" class="form-control" id="owner" name="owner">
  </div>
  <div class="form-group">
    <label for="billing_address">Billing Address</label>
    <input type="text" class="form-control" id="billing_address" name="billing_address">
  </div>
  <div class="form-group">
    <label for="billing_city">Billing City</label>
    <input type="text" class="form-control" id="billing_city" name="billing_city">
  </div>
  <div class="form-group">
    <label for="billing_state">Billing State</label>
    <input type="text" class="form-control" id="billing_state" name="billing_state">
  </div>
  <div class="form-group">
    <label for="billing_zip">Billing Zip</label>
    <input type="text" class="form-control" id="billing_zip" name="billing_zip">
  </div>
  <div class="form-group">
    <label for="billing_amount">Billing Amount</label>
    <input type="number" class="form-control" id="billing_amount" name="billing_amount">
  </div>
  <div class="form-group">
    <label for="active">Active</label>
    <select class="form-control" id="active" name="active">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Create Account</button>
</form>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Billing Address</th>
            <th>Billing City</th>
            <th>Billing State</th>
            <th>Billing Zip</th>
            <th>Billing Amount</th>
            <th>Active</th>
            <th>Account Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
        <tr>
            <td>{{ $account->id }}</td>
            <td>{{ $account->owner }}</td>
            <td>{{ $account->created }}</td>
            <td>{{ $account->modified }}</td>
            <td>{{ $account->billing_address }}</td>
            <td>{{ $account->billing_city }}</td>
            <td>{{ $account->billing_state }}</td>
            <td>{{ $account->billing_zip }}</td>
            <td>{{ $account->billing_amount }}</td>
            <td>{{ $account->active }}</td>
            <td>{{ $account->account_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
