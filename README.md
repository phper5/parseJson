用于处理，因为双引号问题造成的json_decode无法解析。

coce
```
$input = '{"key": "value", "array": [1, 2, 3]  "nested": {"a": "1dfd"f"ss", "b": 2}}';
$p = new ParseJson($input);
var_dump($p());
```

result
```
array(3) {
  ["key"]=>
  string(5) "value"
  ["array"]=>
  array(3) {
    [0]=>
    string(1) "1"
    [1]=>
    string(1) "2"
    [2]=>
    string(1) "3"
  }
  ["nested"]=>
  array(2) {
    ["a"]=>
    string(9) "1dfd"f"ss"
    ["b"]=>
    string(1) "2"
  }
}
```

coce
```
$input = '$input = '{"id":7347953991820,"title":"51mm Tamper","body_html":"u003cpu003eWirsh 51mm Tamper u003cspan data-mce-fragment="1"u003efor Wirsh Espresso Machine, u003c/spanu003eu003cspan data-mce-fragment="1"u003eModel: CM-5418, CM-1665u003c/spanu003eu003c/pu003e","vendor":"Wirsh","product_type":"Coffee Makers u0026 Espresso Machines","created_at":"2023-07-25T00:52:39-07:00","handle":"51mm-tamper","updated_at":"2023-07-30T23:15:17-07:00","published_at":null,"template_suffix":"","status":"draft","published_scope":"web","tags":"","admin_graphql_api_id":"gid://shopify/Product/7347953991820","variants":[{"id":41657018908812,"product_id":7347953991820,"title":"Default Title","price":"0.00","sku":"","position":1,"inventory_policy":"deny","compare_at_price":null,"fulfillment_service":"manual","inventory_management":"shopify","option1":"Default Title","option2":null,"option3":null,"created_at":"2023-07-25T00:52:39-07:00","updated_at":"2023-07-25T23:29:48-07:00","taxable":true,"barcode":"","grams":272,"image_id":null,"weight":0.6,"weight_unit":"lb","inventory_item_id":43755089166476,"inventory_quantity":50,"old_inventory_quantity":50,"requires_shipping":true,"admin_graphql_api_id":"gid://shopify/ProductVariant/41657018908812"}],"options":[{"id":9554238210188,"product_id":7347953991820,"name":"Title","position":1,"values":["Default Title"]}],"images":[{"id":31955384402060,"product_id":7347953991820,"position":1,"created_at":"2023-07-25T01:06:08-07:00","updated_at":"2023-07-25T01:06:41-07:00","alt":"u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e","width":1500,"height":1500,"src":"https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401","variant_ids":[],"admin_graphql_api_id":"gid://shopify/ProductImage/31955384402060"}],"image":{"id":31955384402060,"product_id":7347953991820,"position":1,"created_at":"2023-07-25T01:06:08-07:00","updated_at":"2023-07-25T01:06:41-07:00","alt":"u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e","width":1500,"height":1500,"src":"https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401","variant_ids":[],"admin_graphql_api_id":"gid://shopify/ProductImage/31955384402060"}}';';
$p = new ParseJson($input);
var_dump($p());
```

result
```
array(18) {
  ["id"]=>
  string(13) "7347953991820"
  ["title"]=>
  string(11) "51mm Tamper"
  ["body_html"]=>
  string(194) "u003cpu003eWirsh 51mm Tamper u003cspan data-mce-fragment="1"u003efor Wirsh Espresso Machine, u003c/spanu003eu003cspan data-mce-fragment="1"u003eModel: CM-5418, CM-1665u003c/spanu003eu003c/pu003e"
  ["vendor"]=>
  string(5) "Wirsh"
  ["product_type"]=>
  string(37) "Coffee Makers u0026 Espresso Machines"
  ["created_at"]=>
  string(25) "2023-07-25T00:52:39-07:00"
  ["handle"]=>
  string(11) "51mm-tamper"
  ["updated_at"]=>
  string(25) "2023-07-30T23:15:17-07:00"
  ["published_at"]=>
  string(4) "null"
  ["template_suffix"]=>
  string(0) ""
  ["status"]=>
  string(5) "draft"
  ["published_scope"]=>
  string(3) "web"
  ["tags"]=>
  string(0) ""
  ["admin_graphql_api_id"]=>
  string(35) "gid://shopify/Product/7347953991820"
  ["variants"]=>
  array(1) {
    [0]=>
    array(26) {
      ["id"]=>
      string(14) "41657018908812"
      ["product_id"]=>
      string(13) "7347953991820"
      ["title"]=>
      string(13) "Default Title"
      ["price"]=>
      string(4) "0.00"
      ["sku"]=>
      string(0) ""
      ["position"]=>
      string(1) "1"
      ["inventory_policy"]=>
      string(4) "deny"
      ["compare_at_price"]=>
      string(4) "null"
      ["fulfillment_service"]=>
      string(6) "manual"
      ["inventory_management"]=>
      string(7) "shopify"
      ["option1"]=>
      string(13) "Default Title"
      ["option2"]=>
      string(4) "null"
      ["option3"]=>
      string(4) "null"
      ["created_at"]=>
      string(25) "2023-07-25T00:52:39-07:00"
      ["updated_at"]=>
      string(25) "2023-07-25T23:29:48-07:00"
      ["taxable"]=>
      string(4) "true"
      ["barcode"]=>
      string(0) ""
      ["grams"]=>
      string(3) "272"
      ["image_id"]=>
      string(4) "null"
      ["weight"]=>
      string(3) "0.6"
      ["weight_unit"]=>
      string(2) "lb"
      ["inventory_item_id"]=>
      string(14) "43755089166476"
      ["inventory_quantity"]=>
      string(2) "50"
      ["old_inventory_quantity"]=>
      string(2) "50"
      ["requires_shipping"]=>
      string(4) "true"
      ["admin_graphql_api_id"]=>
      string(43) "gid://shopify/ProductVariant/41657018908812"
    }
  }
  ["options"]=>
  array(1) {
    [0]=>
    array(5) {
      ["id"]=>
      string(13) "9554238210188"
      ["product_id"]=>
      string(13) "7347953991820"
      ["name"]=>
      string(5) "Title"
      ["position"]=>
      string(1) "1"
      ["values"]=>
      array(1) {
        [0]=>
        string(13) "Default Title"
      }
    }
  }
  ["images"]=>
  array(1) {
    [0]=>
    array(11) {
      ["id"]=>
      string(14) "31955384402060"
      ["product_id"]=>
      string(13) "7347953991820"
      ["position"]=>
      string(1) "1"
      ["created_at"]=>
      string(25) "2023-07-25T01:06:08-07:00"
      ["updated_at"]=>
      string(25) "2023-07-25T01:06:41-07:00"
      ["alt"]=>
      string(55) "u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e"
      ["width"]=>
      string(4) "1500"
      ["height"]=>
      string(4) "1500"
      ["src"]=>
      string(89) "https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401"
      ["variant_ids"]=>
      array(0) {
      }
      ["admin_graphql_api_id"]=>
      string(41) "gid://shopify/ProductImage/31955384402060"
    }
  }
  ["image"]=>
  array(11) {
    ["id"]=>
    string(14) "31955384402060"
    ["product_id"]=>
    string(13) "7347953991820"
    ["position"]=>
    string(1) "1"
    ["created_at"]=>
    string(25) "2023-07-25T01:06:08-07:00"
    ["updated_at"]=>
    string(25) "2023-07-25T01:06:41-07:00"
    ["alt"]=>
    string(55) "u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e"
    ["width"]=>
    string(4) "1500"
    ["height"]=>
    string(4) "1500"
    ["src"]=>
    string(89) "https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401"
    ["variant_ids"]=>
    array(0) {
    }
    ["admin_graphql_api_id"]=>
    string(41) "gid://shopify/ProductImage/31955384402060"
  }
}
```