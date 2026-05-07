CREATE TABLE IF NOT EXISTS transport (
    transport_id INT AUTO_INCREMENT PRIMARY KEY,

    student_number VARCHAR(20) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    university_email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),

    transport_type VARCHAR(50) NOT NULL,
    pickup_location VARCHAR(150) NOT NULL,
    dropoff_location VARCHAR(150) NOT NULL,
    travel_date DATE NOT NULL,
    travel_time TIME NOT NULL,

    campus VARCHAR(100),
    reason_for_travel VARCHAR(100),
    accessibility_needs TEXT,

    request_status VARCHAR(30) DEFAULT 'Pending',
    notes TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO transport
(student_number, full_name, university_email, phone_number, transport_type, pickup_location, dropoff_location, travel_date, travel_time, campus, reason_for_travel, accessibility_needs, request_status, notes)
VALUES
('2338980', 'John Smith', 'john.smith@wlv.ac.uk', '07123456789', 'Bus', 'Wolverhampton City Campus', 'Walsall Campus', '2026-05-15', '08:30:00', 'City Campus', 'Lecture', 'None', 'Pending', 'Student needs morning transport for class'),

('2345678', 'Aisha Khan', 'aisha.khan@wlv.ac.uk', '07987654321', 'Shuttle Bus', 'Walsall Campus', 'Wolverhampton City Campus', '2026-05-16', '14:00:00', 'Walsall Campus', 'Library visit', 'Wheelchair access required', 'Pending', 'Needs accessible transport'),

('2356789', 'Daniel Brown', 'daniel.brown@wlv.ac.uk', '07555111222', 'Train', 'Wolverhampton Station', 'Birmingham New Street', '2026-05-18', '09:15:00', 'City Campus', 'Placement interview', 'None', 'Approved', 'Student travelling for university-related placement');
