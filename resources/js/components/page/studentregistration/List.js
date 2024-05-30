import { useState, React } from "react";
import "react-toastify/dist/ReactToastify.css";
import Grid from "@mui/material/Grid";
import Layout from "../../layout/Layout";
import Datatablecomponent from "../../Datatable";

function List() {
  const [searchurl, setSearchurl] = useState("/api/studentinfo");
  const columns = [
    {
      name: "Name",
      selector: (row) => row._name,
      width: "200px",
    },
    {
      name: "District",
      selector: (row) => row._district,
      width: "150px",
    },
    {
      name: "Mobile",
      selector: (row) => row._mobile,
      width: "150px",
    },
    {
      name: "Email",
      selector: (row) => row._email,
      width: "200px",
    },
    {
      name: "Location",
      selector: (row) => row._location,
      width: "150px",
    },
    {
      name: "Event Date",
      selector: (row) => row._eventdate,
      width: "150px",
    },
    {
      name: "Total Bill",
      selector: (row) => row._totalbill,
      width: "150px",
    },
    {
      name: "Transaction ID",
      selector: (row) => row._transactionid,
      width: "250px",
    },
    {
      name: "Payment Status",
      selector: (row) =>
        row._paymentstatus == 0
          ? "UNPAID"
          : row._paymentstatus == 1
          ? "PAID"
          : "CANCELLED",
      width: "150px",
    },
    {
      name: "Status Message",
      selector: (row) => row._statusmessage,
      width: "150px",
    },
  ];

  const renderDatatable = () => {
    return (
      <Datatablecomponent
        columns={columns}
        url={searchurl}
      ></Datatablecomponent>
    );
  };
  return (
    <>
      <Layout>
        <Grid container sx={{ marginTop: "70px" }}>
          <Grid item xs={1}></Grid>
          <Grid item xs={10}>
            {renderDatatable()}
          </Grid>
        </Grid>
      </Layout>
    </>
  );
}

export default List;
