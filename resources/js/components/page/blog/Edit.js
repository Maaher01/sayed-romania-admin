import { useState, useEffect } from "react";
import { Box, Button, TextField } from "@mui/material";
import InputLabel from "@mui/material/InputLabel";
import MenuItem from "@mui/material/MenuItem";
import FormControl from "@mui/material/FormControl";
import Select from "@mui/material/Select";
import axios from "axios";
import "react-toastify/dist/ReactToastify.css";
import { useNavigate } from "react-router-dom";
import Grid from "@mui/material/Grid";
import Layout from "../../layout/Layout";
import BackupIcon from "@mui/icons-material/Backup";
import { toast } from "react-toastify";
import { useParams } from "react-router-dom";
import dayjs from "dayjs";
import ReactQuill from "react-quill";
import "react-quill/dist/quill.snow.css";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";

const Add = () => {
  const navigate = useNavigate();
  const params = useParams();
  const [status, setStatus] = useState("");
  const [imageUrl, setImageUrl] = useState("");
  const [title, setTitle] = useState("");
  const [subtitle, setSubtitle] = useState("");
  const [slug, setSlug] = useState("");
  const [description, setDescription] = useState("");
  const [tags, setTags] = useState("");
  const [publishdate, setPublishdate] = useState(dayjs());

  const [img, setImg] = useState("");

  const handleChangestatus = (event) => {
    setStatus(event.target.value);
  };

  const modules = {
    toolbar: [
      [{ header: "1" }, { header: "2" }, { font: [] }],
      [{ size: [] }],
      ["bold", "italic", "underline", "strike", "blockquote"],
      [
        { list: "ordered" },
        { list: "bullet" },
        { indent: "-1" },
        { indent: "+1" },
      ],
      ["link", "image", "video"],
      ["clean"],
      [{ color: [] }, { background: [] }],
    ],
  };

  const handleSubmit = (event) => {
    event.preventDefault();

    const formData = new FormData(event.currentTarget);

    formData.append("status", status);
    formData.append("image", img);
    formData.append("date", publishdate);
    formData.append("description", description);

    axios
      .post(`/api/blog/update/${params.id}`, formData)
      .then(function (response) {
        if (response.data.errors) {
          toast(response.data.message);
        } else {
          toast("Data Updated Successful");
        }
        navigate("/app/blog");
      })
      .catch((error) => {
        console.log(error.message);
        toast("An Error Occured");
      });
  };

  useEffect(() => {
    fetchData();
  }, []);

  const handleFileUpload = (event) => {
    const file = event.target.files[0];
    setImg(file);
    const reader = new FileReader();

    reader.onloadend = () => {
      setImageUrl(reader.result);
    };
    reader.readAsDataURL(file);
  };

  const fetchData = async () => {
    await axios
      .get(`/api/blog/edit/${params.id}`)
      .then(({ data }) => {
        const alldata = data.data;
        setTitle(alldata._title);
        setSubtitle(alldata._subtitle);
        setStatus(alldata._status);
        setDescription(alldata._description);
        setSlug(alldata._slug);
        setTags(alldata._tags);
        setImageUrl(alldata._image);
        setPublishdate(dayjs(alldata._date));
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
                name="title"
                value={title}
                label="Title"
                variant="outlined"
                onChange={(e) => setTitle(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="subtitle"
                value={subtitle}
                label="Sub Title"
                variant="outlined"
                onChange={(e) => setSubtitle(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
                multiline
                maxRows={10}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <ReactQuill
                name="description"
                label="Description"
                multiline
                value={description}
                onChange={(value) => setDescription(value)}
                style={{ backgroundColor: "white", height: "200px" }}
                modules={modules}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="tags"
                value={tags}
                label="Tags"
                variant="outlined"
                onChange={(e) => setTags(e.target.value)}
                InputProps={{ style: { backgroundColor: "white" } }}
                multiline
                maxRows={10}
              />
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <TextField
                id="standard-basic"
                fullWidth
                name="slug"
                value={slug}
                label="Slug"
                variant="outlined"
                onChange={(e) => setSlug(e.target.value)}
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
                  value={publishdate}
                  onChange={(newValue) => setPublishdate(newValue)}
                  format="YYYY-MM-DD"
                  sx={{ backgroundColor: "white", minWidth: 494 }}
                />
              </LocalizationProvider>
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              <FormControl variant="outlined" sx={{ minWidth: 494 }}>
                <InputLabel>Status</InputLabel>
                <Select
                  labelId="demo-simple-select-standard-label"
                  value={status}
                  onChange={handleChangestatus}
                  label="Status"
                  name="status"
                  sx={{ backgroundColor: "white" }}
                >
                  <MenuItem value="">
                    <em>None</em>
                  </MenuItem>
                  <MenuItem value="1">Active</MenuItem>
                  <MenuItem value="2">In Active</MenuItem>
                </Select>
              </FormControl>
            </Grid>

            <Grid item xs={1} sx={{ mt: 10 }}></Grid>
            <Grid item xs={11} sx={{ mt: 2 }}>
              <Button
                variant="outlined"
                startIcon={<BackupIcon />}
                component="label"
              >
                Upload Logo
                <input
                  type="file"
                  accept="image/*"
                  hidden
                  onChange={handleFileUpload}
                />
              </Button>
            </Grid>
            <Grid item xs={1}></Grid>
            <Grid item xs={11}>
              {imageUrl && (
                <img src={imageUrl} alt="Uploaded Image" height="150" />
              )}
            </Grid>
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
