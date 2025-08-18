<?php
session_start();
error_reporting(E_ALL);
require('fpdf/fpdf.php');
include "database.php"; 
class PDF extends FPDF
{

    function __construct(){
        parent::__construct('L');
    }





// Colored table
function FancyTable($headers, $data, $row_height)
{
   
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $width_sum = 0;
    foreach ($headers as $header_key => $header_data) {
       $this->Cell($header_data['width'], 7, $header_key, 1, 0,'C', true);
       $width_sum += $header_data['width'];
    }

    // $w = array(10, 35, 40, 45 ,70, 70);
    // for($i=0;$i<count($header);$i++)
    //     $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    $img_pos_y=40;
        $header_keys = array_keys($headers);
    foreach ($data as $row) {
        foreach ($header_keys as $header_key) {
           $content = $row[$header_key]['content'];
           $width = $headers[$header_key]['width'];
           $align = $row[$header_key]['align'];

           if($header_key == 'image')
           $content = is_null($content) || $content == ""? 'No Image' : $this->Image('../admin/uploads/'.$content,45,$img_pos_y,30,25);

           $this->Cell($width, $row_height, $content,'LRBT', 0, $align);
        }
        $this->Ln();
        $img_pos_y +=30;
    }



    // foreach($data as $row)
    // {
    //     $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
    //     $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
    //     $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
    //     $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
    //     $this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
    //     $this->Cell($w[5],6,$row[5],'LR',0,'L',$fill);
        
       
    //     $this->Ln();
    //     $fill = !$fill;
    // }
    // Closing line
    $this->Cell($width_sum,0,'','T');
}

}




$type = $_GET['report'];
$report_header = [ 
    'product' => 'Product Reports',
    'supplier' => 'Supplier Report',
    'delivery' => 'Delivery Report',
    'purchase_order' => 'Purchase Order Report',
];
$row_height=30;
//Product Export
if ($type === 'product') {
    $header = [
        'id' => ['width' =>5],
        'product_name'=>['width' =>140],
        'stock' => ['width'=>15],
        'created_by' => ['width'=>45],
        'created_at' => ['width' => 55]
    ];
    $sql = "SELECT *, products.id as pid FROM products INNER JOIN admin ON products.created_by = admin.id ORDER BY products.created_at DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    $data=[];
    // Check if the query was successful

        // Fetch the rows and store them in an array
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        // Process the fetched data using foreach loop
             foreach ($products as $product) {
                $product['created_by'] = $product['first_name'].' '.$product['last_name'];
                unset($product['frist_name'],$product['last_name'],$product['password'],$product['email']);
                     
                     array_walk($product, function(&$str){
                        $str = preg_replace("/\t/", "\\t", $str);
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"'))$str = '"'.str_replace('"', '""',$str).'"';

                     });

                     $data[] = [
                        'id' => [
                            'content' => $product['pid'],
                            'align' => 'C'
                        ],
                        'product_name'=>[
                            'content' =>  $product['product_name'],    
                            'align' => 'C'
                        ],
                        'stock' => [
                            'content' =>  $product['stock'],     
                            'align' => 'C'
                        ],
                        'created_by' =>[
                            'content' =>   $product['created_by'],     
                            'align' => 'C'
                        ],
                        'created_at' => [
                            'content' =>  date('M d,Y h:i:s A',strtotime($product['created_at'])),     
                            'align' => 'C'
                        ] 
                       
                    ];
                     }
 
}

//Supplier Export
if ($type === 'supplier') {
    $header = [
        'supplier_id' => ['width' =>40],
        'supplier_name'=>['width' =>50],
        'supplier_location' => ['width'=>70],
        'created_by' => ['width'=>60],
        'created_at' => ['width' => 60]
        
    ];
    $sql = "SELECT  suppliers.id,suppliers.supplier_name, admin.first_name, admin.last_name, suppliers.supplier_location, suppliers.email, suppliers.created_by, suppliers.created_at  FROM suppliers INNER JOIN admin ON suppliers.created_by = admin.id ORDER BY suppliers.created_at DESC";
    $result = mysqli_query($conn, $sql);
    $is_header = true;
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $suppliers = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    

        // Process the fetched data using foreach loop
             foreach ($suppliers as $supplier) {
                $supplier['created_by'] = $supplier['first_name'].' '.$supplier['last_name'];
                unset($supplier['first_name'],$supplier['last_name']);
                $data[] = [
                    'supplier_id' => [
                        'content' => $supplier['id'],
                        'align' => 'C'
                    ],
                    'supplier_name'=>[
                        'content' =>  $supplier['supplier_name'],    
                        'align' => 'C'
                    ],
                    'supplier_location' => [
                        'content' =>  $supplier['supplier_location'],     
                        'align' => 'C'
                    ],
                    'created_by' =>[
                        'content' =>  $supplier['created_by'],     
                        'align' => 'C'
                    ],
                    'created_at' => [
                        'content' =>  date('M d,Y h:i:s A',strtotime($supplier['created_at'])),     
                        'align' => 'C'
                    ]
                   
                ];
                           

                              }
                              $row_height=10;
    } 
}

//delivery Export
if ($type === 'delivery') {
    $header = [
        'date_received' => ['width' =>50],
        'qty_received'=>['width' =>50],
        'supplier_name' => ['width'=>40],
        'product_name' => ['width'=>50],
        'batch' => ['width'=>50],
        'created_by' => ['width'=>40]
        
    ];
    $sql = "SELECT date_received, qty_received, first_name, last_name, suppliers.supplier_name, products.product_name, batch,order_product.created_by  FROM order_product_history, order_product, suppliers, products, admin 
    WHERE order_product_history.`order-product-Id` = order_product.id
    AND order_product.created_by = admin.id
    AND order_product.supplier = suppliers.id
    AND order_product.product = products.id
    ORDER BY order_product.batch DESC";
    $result = mysqli_query($conn, $sql);
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $deliveries = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $deliveries[] = $row;
        }
      
        
        // Process the fetched data using foreach loop
       
            foreach ($deliveries  as $delivery) {
                $delivery['created_by'] = $delivery['first_name'].' '.$delivery['last_name'];
                unset($delivery['first_name'],$delivery['last_name']);
                $data[] = [
                    'date_received' => [
                        'content' => $delivery['date_received'],
                        'align' => 'C'
                    ],
                    'qty_received'=>[
                        'content' =>  $delivery['qty_received'],    
                        'align' => 'C'
                    ],
                    'supplier_name' => [
                        'content' =>  $delivery['supplier_name'],     
                        'align' => 'C'
                    ],
                    'product_name' => [
                        'content' =>  $delivery['product_name'],     
                        'align' => 'C'
                    ],
                    'batch' => [
                        'content' =>  $delivery['batch'],     
                        'align' => 'C'
                    ],
                    'created_by' =>[
                        'content' =>  $delivery['created_by'],     
                        'align' => 'C'
                    ]
                   
                ];
        }
        $row_height = 10;
            
    } 

}

//Purchase Order Export
if ($type === 'purchase_order') {

    $header = [
        'id' => ['width' =>10],
        'qty_ordered'=>['width' =>30],
        'qty_received'=>['width' =>30],
        'qty_remaining'=>['width' =>35],
        'status' => ['width'=>20],
        'batch' => ['width'=>30],
        'supplier_name' => ['width'=>35],
        'created by' => ['width'=>40],
        'created at' => ['width'=>50],
        
    ];

    $sql = "SELECT  order_product.id,admin.first_name, admin.last_name, order_product.quantity_ordered, order_product.quantity_received, order_product.quantity_remaining, order_product.status, order_product.batch, suppliers.supplier_name, order_product.created_at FROM order_product 
    INNER JOIN admin ON order_product.created_by = admin.id
    INNER JOIN suppliers ON order_product.supplier = suppliers.id ORDER BY order_product.batch DESC";
    $result = mysqli_query($conn, $sql);
  
    // Check if the query was successful
    if ($result) {
        // Fetch the rows and store them in an array
        $order_products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $order_products [] = $row;
        }
        
        //sorting using batch numin array
        
      
        // Process the fetched data using foreach loop
     
            foreach ($order_products  as $order_product) {
                $order_product['created_by'] = $order_product['first_name'].' '.$order_product['last_name'];
                unset($order_product['first_name'],$order_product['last_name']);
                $data[] = [
                    'id' => [
                        'content' => $order_product['id'],
                        'align' => 'C'
                    ],
                    'qty_ordered'=>[
                        'content' =>  $order_product['quantity_ordered'],    
                        'align' => 'C'
                    ],
                    'qty_received' => [
                        'content' =>  $order_product['quantity_received'],     
                        'align' => 'C'
                    ],
                    'qty_remaining' => [
                        'content' =>  $order_product['quantity_remaining'],     
                        'align' => 'C'
                    ],
                    'status' => [
                        'content' =>  $order_product['status'],     
                        'align' => 'C'
                    ],
                    'batch' =>[
                        'content' =>  $order_product['batch'],     
                        'align' => 'C'
                    ],
                    'supplier_name' =>[
                        'content' =>  $order_product['supplier_name'],     
                        'align' => 'C'
                    ],
                    'created by' =>[
                        'content' =>  $order_product['created_by'],     
                        'align' => 'C'
                    ],
                    'created at' =>[
                        'content' =>  $order_product['created_at'],     
                        'align' => 'C'
                    ]
                   
                ];
        }
        $row_height= 15;
    }    
    
}

//start pdf
$pdf = new PDF();
$pdf->SetFont('Arial','',18);
$pdf->AddPage();
$pdf->Cell(100);
$pdf->Cell(50,10, $report_header[$type],1,0,'C');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','',13);

$pdf->FancyTable($header,$data , $row_height);
$pdf->Output();
?>