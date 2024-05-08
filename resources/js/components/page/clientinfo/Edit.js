import { useState, useEffect } from "react";
import { Box, Button, TextField } from "@mui/material";
import axios from "axios";
import "react-toastify/dist/ReactToastify.css";
import { useNavigate } from "react-router-dom";
import Grid from "@mui/material/Grid";
import Layout from "../../layout/Layout";
import { toast } from "react-toastify";
import { useParams } from "react-router-dom";

const Add = () => {
  const navigate = useNavigate();
  const params = useParams();
  const [name, setName] = useState("");
  const [code, setCode] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    const formData = new FormData(event.currentTarget);

    formData.append("name", name);
    formData.append("code", code);

    axios
      .post(`/api/clientinfo/update/${params.id}`, formData)
      .then(function (response) {
        if (response.data.errors) {
          toast(response.data.message);
        } else {
          toast("Data Updated Successful");
        }
        // navigate("/app/dashboard");
      })
      .catch(function (error) {
        console.log(error.message);
        toast("An Error Occured");
      });
  };

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    await axios
      .get(`/api/clientinfo/edit/${params.id}`)
      .then(({ data }) => {
        const alldata = data.data;
        setName(alldata._name);
        setCode(alldata._code);
        toast("Data Found");
      })
      .catch(({ response: { data } }) => {
        toast("No Data Found");
      });
  };

  return (
    <>
      <Layout>
        <Box
          component={"form"}
          onSubmit={handleSubmit}
          sx={{ padding: "20px 60px" }}
        >
          <Grid container spacing={2}>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="name"
                value={name}
                label="Name"
                variant="outlined"
                onChange={(e) => setName(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="code"
                value={code}
                label="Code"
                variant="outlined"
                onChange={(e) => setCode(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
                multiline
                maxRows={10}
              />
            </Grid>
            <Grid item xs={1}></Grid>

            <Grid item xs={1} sx={{ mt: 10 }}></Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <Button
                variant={"contained"}
                type={"submit"}
                sx={{ mt: 3, mb: 2 }}
              >
                Submit
              </Button>
            </Grid>
          </Grid>
        </Box>
      </Layout>
    </>
  );
};

export default Add;
