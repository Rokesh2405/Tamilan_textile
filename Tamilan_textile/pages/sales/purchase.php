<?php

$menu = "4,12,55,";

$thispageid = 33;

include ('../../config/config.inc.php');

$dynamic = '1';

$datatable = '1';

include ('../../require/header.php');



$_SESSION['purchase_id'] = '';

if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {

    $chk = $_REQUEST['chk'];

    $chk = implode('.', $chk);

    $msg = delpurchase($chk);

}

?>

<script type="text/javascript" >

    function validcheck(name)

    {

        var chObj = document.getElementsByName(name);

        var result = false;

        for (var i = 0; i < chObj.length; i++) {

            if (chObj[i].checked) {

                result = true;

                break;

            }

        }

        if (!result) {

            return false;

        } else {

            return true;

        }

    }



    function checkdelete(name)

    {

        if (validcheck(name) == true)

        {

            if (confirm("Please confirm you want to Delete this Purchase(s)"))

            {

                return true;

            } else

            {

                return false;

            }

        } else if (validcheck(name) == false)

        {

            alert("Select the check box whom you want to delete.");

            return false;

        }

    }



</script>

<script type="text/javascript">

    function checkall(objForm) {

        len = objForm.elements.length;

        var i = 0;

        for (i = 0; i < len; i++) {

            if (objForm.elements[i].type == 'checkbox') {

                objForm.elements[i].checked = objForm.check_all.checked;

            }

        }

    }

</script>

<style type="text/css">

    .row { margin:0;}

    #normalexamples tbody tr td:nth-child(1),tbody tr td:nth-child(5),tbody tr td:nth-child(6),tbody tr td:nth-child(7),tbody tr td:nth-child(8) {

        text-align:center;

    }

</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Purchase

            <small>List of Purchase</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo $sitename; ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>

            <li><a href="#"><i class="fa fa-database"></i>Process</a></li>

            <li class="active">Purchase</li>

        </ol>

    </section>

    <!-- Main content -->

    <section class="content">



        <div class="box">

            <div class="box-header">

                <h3 class="box-title"><a href="<?php echo $sitename; ?>pages/sales/addpurchase.php">Add New Purchase</a></h3>
<?php 
                 $sql4 = $db->prepare("SELECT * FROM `purchase` WHERE `status`=1  ");
                 $sql4->execute();
                 $tot = 0;
                 while ($purchase = $sql4->fetch(PDO::FETCH_ASSOC)) 
                {

                    $tot += $purchase['amount']; 
                }

                 ?>
               
                 <h3>TOTAL PURCHASE AMOUNT:<?php echo $tot; ?></h3>
            </div><!-- /.box-header -->

            <div class="box-body">

                <?php echo $msg; ?>

                <form name="form1" method="post" action="">

                    <div class="table-responsive">

                        <table id="normalexamples" class="table table-bordered table-striped">

                            <thead>

                                <tr align="center">

                                    <th style="width:5%;">S.id</th>
                                    
                                    <th style="width:25%">Supplier id</th>

                                    <th style="width:15%">Amount</th>

                                    <th data-sortable="false" align="center" style="text-align: center; padding-right:0; padding-left: 0; width: 10%;">Edit</th>

                                    <th data-sortable="false" align="center" style="text-align: center; padding-right:0; padding-left: 0; width: 10%;"><input name="check_all" id="check_all" value="1" onclick="javascript:checkall(this.form)" type="checkbox" /></th>

                                </tr>

                            </thead>

                            <tbody>

                                

                            </tbody>

                            <tfoot>

                                <tr>

                                    <th colspan="4">&nbsp;</th>

                                    <th style="text-align:center;"><button type="submit" class="btn btn-danger" name="delete" id="delete" value="Delete" onclick="return checkdelete('chk[]');"> DELETE </button></th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </form>

            </div><!-- /.box-body -->

        </div><!-- /.box -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<script type="text/javascript">

    function editthis(a)

    {

        var did = a;

        window.location.href = '<?php echo $sitename; ?>sales/' + a + '/editpurchase.htm';

    }

</script>

<?php

include ('../../require/footer.php');

?>



<script type="text/javascript">

    $('#normalexamples').dataTable({

        "bProcessing": true,

        "bServerSide": true,

        //"scrollX": true,

        "searching": true,

        "sAjaxSource": "<?php echo $sitename; ?>pages/dataajax/gettablevalues.php?types=salespurchasetable",



    });

</script>

