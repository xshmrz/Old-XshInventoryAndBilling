<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         * @return void
         */
        public function up() {
            Schema::create('product_category', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('product_brand', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('product', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('brand_id');
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2);
                $table->integer('stock_quantity');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('category_id')->references('id')->on('product_category')->onDelete('cascade');
                $table->foreign('brand_id')->references('id')->on('product_brand')->onDelete('cascade');
            });
            Schema::create('product_feature', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->string('feature_name');
                $table->string('feature_value');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            });
            Schema::create('stock_warehouse', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('location');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('stock_movement', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('warehouse_id');
                $table->enum('movement_type', ['IN', 'OUT']);
                $table->integer('quantity');
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
                $table->foreign('warehouse_id')->references('id')->on('stock_warehouse')->onDelete('cascade');
            });
            Schema::create('stock_count', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warehouse_id');
                $table->unsignedBigInteger('product_id');
                $table->integer('counted_quantity');
                $table->timestamp('count_date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('warehouse_id')->references('id')->on('stock_warehouse')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            });
            Schema::create('account', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('type_id');
                $table->string('contact_info')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('type_id')->references('id')->on('account_type')->onDelete('cascade');
            });
            Schema::create('account_type', function (Blueprint $table) {
                $table->id();
                $table->string('type_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('account_movement', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->enum('movement_type', ['DEBIT', 'CREDIT']);
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
            });
            Schema::create('account_balance', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->decimal('balance', 10, 2);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
            });
            Schema::create('account_group', function (Blueprint $table) {
                $table->id();
                $table->string('group_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('account_contact', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->enum('contact_type', ['email', 'phone']);
                $table->string('contact_info');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
            });
            Schema::create('invoice', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->unsignedBigInteger('invoice_type_id');
                $table->timestamp('date');
                $table->timestamp('due_date');
                $table->unsignedBigInteger('status_id');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
                $table->foreign('invoice_type_id')->references('id')->on('invoice_type')->onDelete('cascade');
                $table->foreign('status_id')->references('id')->on('invoice_status')->onDelete('cascade');
            });
            Schema::create('invoice_detail', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_id');
                $table->unsignedBigInteger('product_id');
                $table->integer('quantity');
                $table->decimal('unit_price', 10, 2);
                $table->decimal('total_price', 10, 2);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            });
            Schema::create('invoice_type', function (Blueprint $table) {
                $table->id();
                $table->string('type_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('invoice_payment_method', function (Blueprint $table) {
                $table->id();
                $table->string('method_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('payment', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_id');
                $table->unsignedBigInteger('payment_method_id');
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
                $table->foreign('payment_method_id')->references('id')->on('invoice_payment_method')->onDelete('cascade');
            });
            Schema::create('invoice_status', function (Blueprint $table) {
                $table->id();
                $table->string('status_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('invoice_series', function (Blueprint $table) {
                $table->id();
                $table->string('series_code');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('income', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->unsignedBigInteger('income_type_id');
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
                $table->foreign('income_type_id')->references('id')->on('income_expense_type')->onDelete('cascade');
            });
            Schema::create('expense', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->unsignedBigInteger('expense_type_id');
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
                $table->foreign('expense_type_id')->references('id')->on('income_expense_type')->onDelete('cascade');
            });
            Schema::create('income_expense_type', function (Blueprint $table) {
                $table->id();
                $table->string('type_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('income_expense_category', function (Blueprint $table) {
                $table->id();
                $table->string('category_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('cash_movement', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id');
                $table->enum('movement_type', ['IN', 'OUT']);
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
            });
            Schema::create('cash_type', function (Blueprint $table) {
                $table->id();
                $table->string('type_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('bank_account', function (Blueprint $table) {
                $table->id();
                $table->string('account_number');
                $table->string('bank_name');
                $table->string('branch_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('bank_movement', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('bank_account_id');
                $table->enum('movement_type', ['IN', 'OUT']);
                $table->decimal('amount', 10, 2);
                $table->timestamp('date');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('bank_account_id')->references('id')->on('bank_account')->onDelete('cascade');
            });
            Schema::create('user', function (Blueprint $table) {
                $table->id();
                $table->string('username');
                $table->string('password_hash');
                $table->string('email');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            });
            Schema::create('role', function (Blueprint $table) {
                $table->id();
                $table->string('role_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('permission', function (Blueprint $table) {
                $table->id();
                $table->string('permission_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('user_role', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            });
            Schema::create('user_activity_log', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('activity');
                $table->timestamp('timestamp');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            });
            Schema::create('payment_method', function (Blueprint $table) {
                $table->id();
                $table->string('method_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('online_payment_transaction', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_id');
                $table->unsignedBigInteger('payment_method_id');
                $table->decimal('amount', 10, 2);
                $table->timestamp('transaction_date');
                $table->unsignedBigInteger('status_id');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
                $table->foreign('payment_method_id')->references('id')->on('payment_method')->onDelete('cascade');
                $table->foreign('status_id')->references('id')->on('payment_status')->onDelete('cascade');
            });
            Schema::create('payment_status', function (Blueprint $table) {
                $table->id();
                $table->string('status_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('credit_card_info', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('card_number');
                $table->string('cardholder_name');
                $table->string('expiry_date');
                $table->string('cvv');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            });
            Schema::create('payment_provider', function (Blueprint $table) {
                $table->id();
                $table->string('provider_name');
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::create('refund_transaction', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('original_transaction_id');
                $table->decimal('amount', 10, 2);
                $table->timestamp('refund_date');
                $table->unsignedBigInteger('status_id');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('original_transaction_id')->references('id')->on('online_payment_transaction')->onDelete('cascade');
                $table->foreign('status_id')->references('id')->on('payment_status')->onDelete('cascade');
            });
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key');
                $table->string('value');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        /**
         * Reverse the migrations.
         * @return void
         */
        public function down() {
            Schema::dropIfExists('refund_transaction');
            Schema::dropIfExists('payment_provider');
            Schema::dropIfExists('credit_card_info');
            Schema::dropIfExists('payment_status');
            Schema::dropIfExists('online_payment_transaction');
            Schema::dropIfExists('payment_method');
            Schema::dropIfExists('user_activity_log');
            Schema::dropIfExists('user_role');
            Schema::dropIfExists('permission');
            Schema::dropIfExists('role');
            Schema::dropIfExists('user');
            Schema::dropIfExists('bank_movement');
            Schema::dropIfExists('bank_account');
            Schema::dropIfExists('cash_type');
            Schema::dropIfExists('cash_movement');
            Schema::dropIfExists('income_expense_category');
            Schema::dropIfExists('income_expense_type');
            Schema::dropIfExists('expense');
            Schema::dropIfExists('income');
            Schema::dropIfExists('invoice_series');
            Schema::dropIfExists('invoice_status');
            Schema::dropIfExists('payment');
            Schema::dropIfExists('invoice_payment_method');
            Schema::dropIfExists('invoice_type');
            Schema::dropIfExists('invoice_detail');
            Schema::dropIfExists('invoice');
            Schema::dropIfExists('account_contact');
            Schema::dropIfExists('account_group');
            Schema::dropIfExists('account_balance');
            Schema::dropIfExists('account_movement');
            Schema::dropIfExists('account_type');
            Schema::dropIfExists('account');
            Schema::dropIfExists('stock_count');
            Schema::dropIfExists('stock_movement');
            Schema::dropIfExists('stock_warehouse');
            Schema::dropIfExists('product_feature');
            Schema::dropIfExists('product');
            Schema::dropIfExists('product_brand');
            Schema::dropIfExists('product_category');
            Schema::dropIfExists('settings');
        }
    };
