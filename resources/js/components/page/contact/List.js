import { useState } from "react";
import { Button } from "@mui/material";
import "react-toastify/dist/ReactToastify.css";
import Grid from "@mui/material/Grid";
import Layout from "../../layout/Layout";
import Datatablecomponent from "../../Datatable";
import { Link } from "react-router-dom";
import AddIcon from "@mui/icons-material/Add";
import CreateIcon from "@mui/icons-material/Create";

const List = () => {
  const [delrow, setDelrow] = useState(0);
  const [searchurl, setSearchurl] = useState("/api/contact");
  const columns = [
    {
      name: "Name",
      selector: (row) => row._name,
      center: true,
    },
    {
      name: "Phone",
      selector: (row) => row._phone,
      center: true,
    },
    {
      name: "Email",
      selector: (row) => row._email,
      center: true,
    },
    {
      name: "Address",
      selector: (row) => row._address,
      center: true,
    },
    {
      name: "Action",
      cell: (row) => (
        <div style={{ display: "flex", gap: "10px" }}>
          <Link to={`/app/contact/edit/${row.id}`} className="btn">
            <i className="material-icons text-warning">
              <CreateIcon sx={{ color: "green" }} />
            </i>
          </Link>
        </div>
      ),
      selector: (row) => row.id,
      center: true,
    },
  ];

  const renderDatatable = () => {
    return (
      <Datatablecomponent
        columns={columns}
        url={searchurl}
        delrow={delrow}
      ></Datatablecomponent>
    );
  };
  return (
    <>
      <Layout>
        <Grid container>
          <Grid item xs={1}></Grid>
          <Grid item xs={11}>
            <Link to="/app/contact/add" className="btn">
              <Button
                variant="contained"
                startIcon={<AddIcon />}
                sx={{ marginBottom: "30px" }}
              >
                ADD
              </Button>
            </Link>
          </Grid>
          <Grid item xs={1}></Grid>
          <Grid item xs={10}>
            {renderDatatable()}
          </Grid>
        </Grid>
      </Layout>
    </>
  );
};

export default List;
