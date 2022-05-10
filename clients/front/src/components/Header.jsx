import "bootstrap/dist/css/bootstrap.css";
import { Link } from "react-router-dom";

const Header = () => {
  
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <div className="container">
        <Link className="navbar-brand" to="/">
          Navbar
        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mr-auto">
            <li className={(nav) => (nav.isActive ? "active" : "")}>
              <Link className="nav-link" to="/">
                Accueil
              </Link>
            </li>
            <li className={(nav) => (nav.isActive ? "active" : "")}>
              <Link className="nav-link" to="/test">
                Test
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Header;