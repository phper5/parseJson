<?php
class ParseJson
{
    protected $pos = 0;
    protected $input = "";
    protected $len = 0;

    public function __construct($input)
    {
        $this->pos = 0;
        $this->input = $input;
        $this->len = strlen($input);
    }
    protected function skipWhitespace() {
        while ($this->pos < $this->len && ctype_space($this->input[$this->pos])) {
            $this->pos++;
        }
    }
    public function parseValue() {

        $this->skipWhitespace();
        
        if ($this->pos >= $this->len) {
            return null;
        }
        
        $char = $this->input[$this->pos];
        
        if ($char === '"') {
            return [
                'type'=>'string',
                'val'=>$this->parseString(),
            ];
        } elseif ($char === '{') {
            return [
                'val' => $this->parseObject(),
                'type'=>'object'
            ];
        } elseif ($char === '[') {
            return [
                'val'=>$this->parseArray(),
                'type'=>'array'
            ];
        } 
        elseif (ctype_digit($char) || $char === '-') {
            return [
                'type'=>'number',
                'val'=>$this->parseNumber()
            ];
        } 
        elseif ($char === 't') {
            if(substr($this->input,$this->pos,4)=='true'){
                return [
                    'type'=>'null',
                    'val'=>$this->parseTrue(),
                ];
            }else{
                return [
                    'type'=>'string',
                    'val'=>$this->parseString(),
                ];
            }
            
        } elseif ($char === 'f') {
            if(substr($this->input,$this->pos,5)=='false'){
                return [
                    'type'=>'boolen',
                    'val'=>$this->parseFalse(),
                ];
            }else{
                return [
                    'type'=>'string',
                    'val'=>$this->parseString(),
                ];
            }
            
        } 
        elseif ($char === 'n') {
            if(substr($this->input,$this->pos,4)=='null'){
                return [
                    'type'=>'null',
                    'val'=>$this->parseNull(),
                ];
            }else{
                return [
                    'type'=>'string',
                    'val'=>$this->parseString(),
                ];
            }
           
        }elseif ($char === '}') {
            return null;
        }else{
            return [
                'type'=>'string',
                'val'=>$this->parseString(),
            ];
        }
        
        return null;
    }
    
    protected function parseString() {
        
        if( $this->input[$this->pos] == '"'){
            $this->pos++;
        } // 跳过初始的双引号
        
        $str = '';
        while ($this->pos < $this->len && $this->input[$this->pos] !== '"') {
            $str .= $this->input[$this->pos++];
        }
        
        $this->pos++; // 跳过结束的双引号
        
        return $str;
    }
    
    protected function parseObject() {
        
        $this->pos++; // 跳过初始的左花括号
        
        $obj = [];
        while ($this->pos < $this->len && $this->input[$this->pos] !== '}') {
            $this->skipWhitespace();
            if ($this->input[$this->pos] === ',') {
                $this->pos++;
                continue;
            }
            
            $key = $this->parseString();
            if ($key === null) {
                break;
            }
            
            $this->skipWhitespace();
            if ($this->input[$this->pos] !== ':') {

                break;
            }
            $this->pos++; // 跳过冒号
            
            $value = $this->parseValue();
           
            
            if ($value !== null && $value['val']!== null) {
                $type = $value['type'];            
                $value  = $value['val'];
                $obj[$key] = $value;  
                if($type =='string' || $type =='number'){
                    $lastPos=$this->pos-strlen($value)-1;
                    $point=$this->pos;
                    $append = true;
                    while( $append){
                        $this->skipWhitespace();
                        if ($this->input[$this->pos] === ',') {
                            $this->pos++;
                            continue;
                        }
                        $this->skipWhitespace();
                                      //判断再往下是没有：有，则合并。
                        $next = $this->parseValue();
                        if($next && ($next['type']=='string' || $next['type'] == 'number') && $this->input[$this->pos]!==':'){
                            $obj[$key] = substr($this->input,$lastPos,$this->pos-$lastPos-1);
                            $point=$this->pos;
                        }else{
                            $this->pos=$point;//重新开始
                            $append = false;
                        }    
                    }
                }
                
                
            } else {
                break;
            }
        }
        
        $this->pos++; // 跳过结束的右花括号
        
        return $obj;
    }
    
    protected function parseArray() {
        
        $this->pos++; // 跳过初始的左方括号
        
        $arr = [];
        while ($this->pos < $this->len && $this->input[$this->pos] !== ']') {
            $this->skipWhitespace();
            if ($this->input[$this->pos] === ',') {
                $this->pos++;
                continue;
            }
            
            $value = $this->parseValue();
            
            if ($value !== null && $value['val']!== null) {
                $value  = $value['val'];
                $arr[] = $value;
            } else {
                break;
            }
        }
        
        $this->pos++; // 跳过结束的右方括号
        
        return $arr;
    }
    
    protected function parseNumber() {
        
        $start = $this->pos;
        while ($this->pos < $this->len && (ctype_digit($this->input[$this->pos]) || $this->input[$this->pos] === '.' || $this->input[$this->pos] === 'e' || $this->input[$this->pos] === 'E' || $this->input[$this->pos] === '-')) {
            $this->pos++;
        }
        
        return substr($this->input, $start, $this->pos - $start);
    }
    
    protected function parseTrue() {
        
        $this->pos += 4; // 跳过 "true"
        return 'true';
    }
    
    protected function parseFalse() {
        
        $this->pos += 5; // 跳过 "false"
        return 'false';
    }
    
    protected function parseNull() {
        
        $this->pos += 4; // 跳过 "null"
        return 'null';
    }
    public function __invoke() {
        $data = $this->parseValue();   
        return $data['val'];
      }
}

$input = '{"key": "value", "array": [1, 2, 3]  "nested": {"a": "1dfd"f"ss", "b": 2}}';
//$input = '{"id":7347953991820,"title":"51mm Tamper","body_html":"u003cpu003eWirsh 51mm Tamper u003cspan data-mce-fragment="1"u003efor Wirsh Espresso Machine, u003c/spanu003eu003cspan data-mce-fragment="1"u003eModel: CM-5418, CM-1665u003c/spanu003eu003c/pu003e","vendor":"Wirsh","product_type":"Coffee Makers u0026 Espresso Machines","created_at":"2023-07-25T00:52:39-07:00","handle":"51mm-tamper","updated_at":"2023-07-30T23:15:17-07:00","published_at":null,"template_suffix":"","status":"draft","published_scope":"web","tags":"","admin_graphql_api_id":"gid://shopify/Product/7347953991820","variants":[{"id":41657018908812,"product_id":7347953991820,"title":"Default Title","price":"0.00","sku":"","position":1,"inventory_policy":"deny","compare_at_price":null,"fulfillment_service":"manual","inventory_management":"shopify","option1":"Default Title","option2":null,"option3":null,"created_at":"2023-07-25T00:52:39-07:00","updated_at":"2023-07-25T23:29:48-07:00","taxable":true,"barcode":"","grams":272,"image_id":null,"weight":0.6,"weight_unit":"lb","inventory_item_id":43755089166476,"inventory_quantity":50,"old_inventory_quantity":50,"requires_shipping":true,"admin_graphql_api_id":"gid://shopify/ProductVariant/41657018908812"}],"options":[{"id":9554238210188,"product_id":7347953991820,"name":"Title","position":1,"values":["Default Title"]}],"images":[{"id":31955384402060,"product_id":7347953991820,"position":1,"created_at":"2023-07-25T01:06:08-07:00","updated_at":"2023-07-25T01:06:41-07:00","alt":"u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e","width":1500,"height":1500,"src":"https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401","variant_ids":[],"admin_graphql_api_id":"gid://shopify/ProductImage/31955384402060"}],"image":{"id":31955384402060,"product_id":7347953991820,"position":1,"created_at":"2023-07-25T01:06:08-07:00","updated_at":"2023-07-25T01:06:41-07:00","alt":"u003cimg src="tamper.jpg" alt="wirsh 51mm tamper"/u003e","width":1500,"height":1500,"src":"https://cdn.shopify.com/s/files/1/0569/8247/0796/files/wirsh-51mm-tamper.jpg?v=1690272401","variant_ids":[],"admin_graphql_api_id":"gid://shopify/ProductImage/31955384402060"}}';
$p = new ParseJson($input);
print_r($p());