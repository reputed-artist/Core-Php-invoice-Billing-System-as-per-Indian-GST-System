<form action="" method="GET">
             &nbsp;&nbsp;&nbsp; <b> Supplier Name </b> &nbsp;

                          <select name="client" class="form-control select2" style="height:32px;width:30%;border-radius:0px;" >
                            <option> </option>
                          <?php $ret=mysqli_query($con,"select pcname from purchasecom");
                              $cnt=1;
                                  if(mysqli_num_rows($ret)==0)
                                  {
                                    echo "No Records Found";
                                  }
                                  while($row=mysqli_fetch_array($ret))
                                  { ?>

                          
                                  <option value="<?php echo $row['pcname'];?>"> <?php echo $row['pcname']; ?> </option>

                                  <?php } ?> 
                                </select>

                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Year </b> &nbsp;
         
                               <select name="year" class="form-control select2" style="height:32px;width:20%;border-radius:0px;" >
                                  <option> Year</option>
                                <?php $yr =mysqli_query($con,"SELECT CASE WHEN MONTH(created)>=4 THEN concat(YEAR(created), '-',YEAR(created)+1) ELSE concat(YEAR(created)-1,'-', YEAR(created)) END AS financial_year FROM invtest2 GROUP BY financial_year order by financial_year DESC");
                                  
                                    $cnt=1;
                                    if(mysqli_num_rows($yr)==0)
                                    {
                                      echo "No Records Found";
                                    }
                                    while($row=mysqli_fetch_array($yr))
                                    { ?>

                                
                                  <option value="<?php echo $row['financial_year'];?>"> <?php echo $row['financial_year']; ?> </option>

                                  <?php } ?> 
                                </select>

                                </br>
                                </br>
                                  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-success" name="submit">
                                </form>