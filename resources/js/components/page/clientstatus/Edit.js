import { useState, useEffect } from "react";
import { Box, Button, TextField } from "@mui/material";
import axios from "axios";
import "react-toastify/dist/ReactToastify.css";
import { useNavigate } from "react-router-dom";
import Grid from "@mui/material/Grid";
import Layout from "../../layout/Layout";
import { toast } from "react-toastify";
import { useParams } from "react-router-dom";
import dayjs from "dayjs";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";

const Add = () => {
  const navigate = useNavigate();
  const params = useParams();
  const [clientcode, setClientcode] = useState("");
  const [status, setStatus] = useState("");
  const [date, setDate] = useState(dayjs());

  const handleSubmit = (event) => {
    event.preventDefault();
    const formData = new FormData(event.currentTarget);

    formData.append("clientcode", clientcode);
    formData.append("status", status);
    formData.append("date", date);

    axios
      .post(`/api/clientstatus/update/${params.id}`, formData)
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
      .get(`/api/clientstatus/edit/${params.id}`)
      .then(({ data }) => {
        const alldata = data.data;
        setClientcode(alldata._clientcode);
        setStatus(alldata._status);
        setDate(dayjs(alldata._date));
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
                name="clientcode"
                value={clientcode}
                label="Client Code"
                variant="outlined"
                onChange={(e) => setClientcode(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="status"
                value={status}
                label="Status"
                variant="outlined"
                onChange={(e) => setStatus(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
                multiline
                maxRows={10}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11} sx={{ mt: 2 }}>
              <LocalizationProvider dateAdapter={AdapterDayjs}>
                <DatePicker
                  label="Date"
                  value={date}
                  onChange={(newValue) => setDate(newValue)}
                  format="YYYY-MM-DD"
                  sx={{ backgroundColor: "white", minWidth: 494 }}
                />
              </LocalizationProvider>
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
